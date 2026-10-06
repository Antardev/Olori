<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\StoreCategoryRequest;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\Promotion;
use App\Http\Requests\StorePromotionRequest;
use App\Support\DemoData;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    public function dashboard()
    {
        $monthStart = now()->startOfMonth();
        $previousMonthStart = $monthStart->copy()->subMonth();
        $previousMonthEnd = $monthStart->copy()->subSecond();
        $salesStatuses = ['en_attente', 'expediee', 'livree'];

        $currentOrders = Order::query()
            ->whereIn('status', $salesStatuses)
            ->where('created_at', '>=', $monthStart);
        $previousOrders = Order::query()
            ->whereIn('status', $salesStatuses)
            ->whereBetween('created_at', [$previousMonthStart, $previousMonthEnd]);

        $sales = (clone $currentOrders)->sum('total');
        $ordersCount = (clone $currentOrders)->count();
        $customersCount = (clone $currentOrders)->distinct('email')->count('email');
        $averageOrder = $ordersCount ? (int) round($sales / $ordersCount) : 0;

        return view('admin.dashboard', [
            'orders'    => Order::latest()->take(5)->get(),
            'statuses'  => Order::STATUSES,
            'lowStock'  => Product::published()->where('stock', '<=', 2)->orderBy('stock')->get(),
            'kpis'      => [
                'ventes' => $sales,
                'commandes' => $ordersCount,
                'clients' => $customersCount,
                'panier_moyen' => $averageOrder,
                'ventes_tendance' => $this->percentageChange($sales, (clone $previousOrders)->sum('total')),
                'commandes_tendance' => $this->percentageChange($ordersCount, (clone $previousOrders)->count()),
                'clients_tendance' => $this->percentageChange(
                    $customersCount,
                    (clone $previousOrders)->distinct('email')->count('email')
                ),
                'panier_tendance' => $this->percentageChange(
                    $averageOrder,
                    ($previousOrders->count() > 0)
                        ? (int) round($previousOrders->sum('total') / $previousOrders->count())
                        : 0
                ),
            ],
        ]);
    }

    private function percentageChange(int $current, int $previous): ?int
    {
        if ($previous === 0) {
            return $current === 0 ? 0 : null;
        }

        return (int) round(($current - $previous) / $previous * 100);
    }

    public function products()
    {
        return view('admin.products', [
            'products'   => Product::latest()->get(),
            'categories' => DemoData::categories(),
        ]);
    }

    public function productForm()
    {
        $subcategories = Category::query()
            ->orderBy('collection')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get()
            ->groupBy('collection')
            ->map(fn ($categories) => $categories->pluck('name', 'slug'))
            ->toArray();

        return view('admin.product-form', [
            'categories'    => DemoData::categories(),
            'subcategories' => $subcategories,
            'badges'     => Product::BADGES,
        ]);
    }

    public function categories()
    {
        return view('admin.categories', [
            'collections' => DemoData::categories(),
            'categories'  => Category::query()->orderBy('collection')->orderBy('sort_order')->orderBy('name')->get()->groupBy('collection'),
        ]);
    }

    public function storeCategory(StoreCategoryRequest $request)
    {
        $data = $request->validated();
        $slug = Category::makeSlug($data['name']);

        if (! $slug || Category::where('collection', $data['collection'])->where('slug', $slug)->exists()) {
            return back()->withInput()->withErrors(['name' => 'Cette catégorie existe déjà dans cette collection.']);
        }

        Category::create([
            'collection' => $data['collection'],
            'slug'       => $slug,
            'name'       => $data['name'],
            'sort_order' => Category::where('collection', $data['collection'])->max('sort_order') + 1,
        ]);

        return redirect()->route('admin.categories')->with('status', 'La catégorie a été ajoutée à la collection.');
    }

    public function updateCategory(StoreCategoryRequest $request, Category $category)
    {
        $data = $request->validated();
        $slug = Category::makeSlug($data['name']);

        if (! $slug || Category::where('collection', $data['collection'])
            ->where('slug', $slug)->where('id', '!=', $category->id)->exists()) {
            return back()->withInput()->withErrors(['name' => 'Cette catégorie existe déjà dans cette collection.']);
        }

        $category->update([
            'collection' => $data['collection'],
            'slug'       => $slug,
            'name'       => $data['name'],
        ]);

        return redirect()->route('admin.categories')->with('status', 'La catégorie a été modifiée.');
    }

    public function destroyCategory(Category $category)
    {
        if (Product::where('subcategory', $category->slug)->where('category', $category->collection)->exists()) {
            return back()->withErrors(['category' => 'Cette catégorie ne peut pas être supprimée car elle contient des articles.']);
        }

        $category->delete();

        return redirect()->route('admin.categories')->with('status', 'La catégorie a été supprimée.');
    }

    /**
     * Enregistre un nouvel article. Publié, il apparaît aussitôt en tête de
     * la page de sa catégorie ; en brouillon, il reste visible du seul admin.
     */
    public function storeProduct(StoreProductRequest $request)
    {
        $data = $request->validated();

        $product = Product::create([
            'slug'         => Product::uniqueSlug($data['name']),
            'name'         => $data['name'],
            'category'     => $data['category'],
            'subcategory'  => $data['subcategory'],
            'price'        => $data['price'],
            'old_price'    => $data['old_price'] ?? null,
            'badge'        => $data['badge'] ?? null,
            'sizes'        => $data['category'] === 'accessoires' ? [] : ($request->list('sizes') ?: ['Unique']),
            'colors'       => $request->list('colors'),
            'stock'        => $data['stock'],
            'description'  => $data['description'] ?? null,
            'is_published' => $request->input('action') !== 'draft',
        ]);

        // La photo n'est déplacée qu'une fois l'article en base : un échec
        // d'enregistrement ne laisse donc pas de fichier orphelin sur le disque.
        if ($request->hasFile('photo')) {
            $photos = $request->file('photo');
            $paths = array_map(fn ($photo) => $this->storePhoto($photo, $product->slug), $photos);
            $product->update([
                'image'  => $paths[0],
                'images' => array_slice($paths, 1),
            ]);
        }

        $message = $product->is_published
            ? "« {$product->name} » est en ligne dans la catégorie {$product->category_label}."
            : "« {$product->name} » est enregistré en brouillon.";

        return redirect()->route('admin.products')->with('status', $message);
    }

    /**
     * Retire un article du catalogue, ainsi que sa photo sur le disque.
     * S'il figure encore dans un panier en session, il en disparaît de
     * lui-même : le panier ignore les articles introuvables.
     */
    public function destroyProduct(Product $product)
    {
        $name = $product->name;

        if ($product->image && file_exists(public_path($product->image))) {
            unlink(public_path($product->image));
        }

        foreach ($product->images ?? [] as $image) {
            if (file_exists(public_path($image))) {
                unlink(public_path($image));
            }
        }

        $product->delete();

        return redirect()->route('admin.products')
            ->with('status', "« {$name} » a été supprimé du catalogue.");
    }

    /** Enregistre la photo dans public/images/produits et renvoie son chemin. */
    private function storePhoto($file, string $slug): string
    {
        $directory = public_path('images/produits');

        if (! is_dir($directory)) {
            mkdir($directory, 0755, true);
        }

        $name = $slug.'-'.now()->format('YmdHis').'-'.bin2hex(random_bytes(4)).'.'.$file->getClientOriginalExtension();
        $file->move($directory, $name);

        return 'images/produits/'.$name;
    }

    public function orders()
    {
        return view('admin.orders', ['orders' => Order::latest()->get(), 'statuses' => Order::STATUSES]);
    }

    public function orderShow(Order $order)
    {
        return view('admin.order-show', ['order' => $order, 'statuses' => Order::STATUSES]);
    }

    public function updateOrderStatus(Request $request, Order $order)
    {
        $data = $request->validate([
            'status' => ['required', 'string', Rule::in(array_keys(Order::STATUSES))],
        ]);

        $order->update(['status' => $data['status']]);

        return back()->with('status', "Le statut de la commande {$order->ref} a été mis à jour.");
    }

    public function promotions()
    {
        return view('admin.promotions', [
            'promotions' => Promotion::with('products:id,name')->latest()->get(),
            'products' => Product::orderBy('name')->get(['id', 'name']),
        ]);
    }

    public function storePromotion(StorePromotionRequest $request)
    {
        $data = $request->validated();
        $productIds = $data['product_ids'] ?? [];
        unset($data['product_ids']);

        $promotion = Promotion::create([
            ...$data,
            'is_active' => $request->boolean('is_active', true),
        ]);
        $promotion->products()->sync($productIds);

        return redirect()->route('admin.promotions')->with('status', 'Le code promotionnel a été créé.');
    }

    public function updatePromotion(StorePromotionRequest $request, Promotion $promotion)
    {
        $data = $request->validated();
        $productIds = $data['product_ids'] ?? [];
        unset($data['product_ids']);

        $promotion->update([
            ...$data,
            'is_active' => $request->boolean('is_active'),
        ]);
        $promotion->products()->sync($productIds);

        return redirect()->route('admin.promotions')->with('status', 'Le code promotionnel a été modifié.');
    }

    public function stats()
    {
        $salesStatuses = ['en_attente', 'expediee', 'livree'];
        $periodStart = now()->startOfMonth()->subMonths(5);
        $monthly = collect(range(5, 0))->map(function (int $monthsAgo) use ($salesStatuses) {
            $month = now()->startOfMonth()->subMonths($monthsAgo);

            return [
                'mois' => ucfirst($month->translatedFormat('F')),
                'ca' => Order::whereIn('status', $salesStatuses)
                    ->whereBetween('created_at', [$month, $month->copy()->endOfMonth()])
                    ->sum('total'),
            ];
        })->all();

        $orders = Order::whereIn('status', $salesStatuses)
            ->where('created_at', '>=', $periodStart)
            ->get(['items', 'total']);
        $soldProducts = [];

        foreach ($orders as $order) {
            foreach ($order->items ?? [] as $item) {
                $product = $item['product'] ?? [];
                $productId = $product['id'] ?? $product['slug'] ?? $product['name'] ?? 'inconnu';
                $quantity = (int) ($item['qty'] ?? 0);
                $price = (int) ($product['price'] ?? 0);

                if (! isset($soldProducts[$productId])) {
                    $soldProducts[$productId] = [
                        'name' => $product['name'] ?? 'Article supprimé',
                        'price' => $price,
                        'quantity' => 0,
                        'revenue' => 0,
                    ];
                }

                $soldProducts[$productId]['quantity'] += $quantity;
                $soldProducts[$productId]['revenue'] += $price * $quantity;
            }
        }

        $top = collect($soldProducts)->sortByDesc('quantity')->take(5)->values();

        return view('admin.stats', [
            'top' => $top,
            'monthly' => $monthly,
            'stats' => [
                'ventes' => collect($monthly)->sum('ca'),
                'commandes' => $orders->count(),
                'articles' => $top->sum('quantity'),
                'panier_moyen' => $orders->count() ? (int) round($orders->sum('total') / $orders->count()) : 0,
            ],
        ]);
    }
}

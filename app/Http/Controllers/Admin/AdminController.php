<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\StoreCategoryRequest;
use App\Models\Category;
use App\Models\Product;
use App\Support\DemoData;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard', [
            'orders'    => DemoData::orders(),
            'statuses'  => DemoData::statuses(),
            'lowStock'  => Product::published()->where('stock', '<=', 2)->orderBy('stock')->get(),
            'kpis'      => ['ventes' => 1240000, 'commandes' => 47, 'visites' => 3210, 'panier_moyen' => 26400],
        ]);
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
        return view('admin.product-form', [
            'categories' => DemoData::categories(),
            'subcategories' => Category::query()->orderBy('sort_order')->orderBy('name')->get()->groupBy('collection')->map(fn ($items) => $items->pluck('name', 'slug'))->all(),
            'tones'      => Product::TONES,
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
            'tone'         => $data['tone'],
            'badge'        => $data['badge'] ?? null,
            'sizes'        => $request->list('sizes') ?: ['Unique'],
            'colors'       => $request->list('colors'),
            'stock'        => $data['stock'],
            'description'  => $data['description'] ?? null,
            'is_published' => $request->input('action') !== 'draft',
        ]);

        // La photo n'est déplacée qu'une fois l'article en base : un échec
        // d'enregistrement ne laisse donc pas de fichier orphelin sur le disque.
        if ($request->hasFile('photo')) {
            $product->update(['image' => $this->storePhoto($request, $product->slug)]);
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

        $product->delete();

        return redirect()->route('admin.products')
            ->with('status', "« {$name} » a été supprimé du catalogue.");
    }

    /** Enregistre la photo dans public/images/produits et renvoie son chemin. */
    private function storePhoto(Request $request, string $slug): string
    {
        $file = $request->file('photo');
        $name = $slug.'-'.now()->format('YmdHis').'.'.$file->getClientOriginalExtension();
        $file->move(public_path('images/produits'), $name);

        return 'images/produits/'.$name;
    }

    public function orders()
    {
        return view('admin.orders', ['orders' => DemoData::orders(), 'statuses' => DemoData::statuses()]);
    }

    public function promotions()
    {
        return view('admin.promotions');
    }

    public function stats()
    {
        return view('admin.stats', [
            'top' => Product::published()->orderByDesc('reviews')->take(5)->get(),
            'monthly' => [
                ['mois' => 'Février', 'ca' => 680000], ['mois' => 'Mars', 'ca' => 820000],
                ['mois' => 'Avril', 'ca' => 910000], ['mois' => 'Mai', 'ca' => 1050000],
                ['mois' => 'Juin', 'ca' => 1180000], ['mois' => 'Juillet', 'ca' => 1240000],
            ],
        ]);
    }
}

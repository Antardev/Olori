<?php

namespace App\Http\Requests;

use App\Models\Product;
use App\Models\Category;
use App\Support\DemoData;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreProductRequest extends FormRequest
{
    /** L'accès est déjà filtré par les middlewares auth + admin de la route. */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'        => ['required', 'string', 'max:120'],
            'category'    => ['required', Rule::in(array_keys(DemoData::categories()))],
            'subcategory' => ['required', Rule::in(Category::where('collection', $this->input('category'))->pluck('slug')->all())],
            'price'       => ['required', 'integer', 'min:0'],
            'old_price'   => ['nullable', 'integer', 'gt:price'],
            'stock'       => ['required', 'integer', 'min:0'],
            'badge'       => ['nullable', Rule::in(Product::BADGES)],
            'sizes'       => [Rule::excludeIf($this->input('category') === 'accessoires'), 'nullable', 'string', 'max:120'],
            'colors'      => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:2000'],
            'photo'       => ['nullable', 'array', 'max:5'],
            'photo.*'     => ['image', 'mimes:jpeg,jpg,png,webp', 'max:4096'],
        ];
    }

    public function attributes(): array
    {
        return [
            'name'        => "nom de l'article",
            'category'    => 'collection',
            'subcategory' => 'catégorie',
            'price'       => 'prix',
            'old_price'   => 'prix barré',
            'stock'       => 'stock',
            'badge'       => 'pastille',
            'sizes'       => 'tailles',
            'colors'      => 'coloris',
            'description' => 'description',
            'photo'       => 'photos',
        ];
    }

    public function messages(): array
    {
        return [
            'required'    => 'Renseignez le champ « :attribute ».',
            'integer'     => 'Le champ « :attribute » doit être un nombre entier.',
            'string'      => 'Le champ « :attribute » doit être du texte.',
            'in'          => 'Choisissez une valeur proposée pour « :attribute ».',
            'min.numeric' => 'Le champ « :attribute » ne peut pas être négatif.',
            'max.string'  => 'Le champ « :attribute » ne doit pas dépasser :max caractères.',
            'old_price.gt' => 'Le prix barré doit être supérieur au prix de vente.',
            'photo.array'   => 'Sélectionnez au maximum 5 photos.',
            'photo.max'     => 'Sélectionnez au maximum 5 photos.',
            'photo.*.image' => 'L\'un des fichiers envoyés n\'est pas une image.',
            'photo.*.mimes' => 'Les photos doivent être au format JPG, PNG ou WebP.',
            'photo.*.max'   => 'Chaque photo ne doit pas dépasser 4 Mo.',
        ];
    }

    /** « S, M, L » → ['S', 'M', 'L'] */
    public function list(string $field): array
    {
        $value = $this->validated()[$field] ?? null;

        if (! $value) {
            return [];
        }

        return array_values(array_filter(array_map('trim', explode(',', $value))));
    }
}

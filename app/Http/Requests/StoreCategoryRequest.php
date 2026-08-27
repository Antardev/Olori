<?php

namespace App\Http\Requests;

use App\Support\DemoData;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Category;

class StoreCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'collection' => ['required', Rule::in(array_keys(DemoData::categories()))],
            'name'       => ['required', 'string', 'max:80'],
        ];
    }

    public function category(): ?Category
    {
        return $this->route('category');
    }

    public function attributes(): array
    {
        return [
            'collection' => 'collection',
            'name'       => 'nom de la catégorie',
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'Renseignez le champ « :attribute ».',
            'string'   => 'Le champ « :attribute » doit être du texte.',
            'max.string' => 'Le champ « :attribute » ne doit pas dépasser :max caractères.',
            'in'       => 'Choisissez une collection proposée.',
        ];
    }
}

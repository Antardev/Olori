<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePromotionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $promotion = $this->route('promotion');

        return [
            'code' => [
                'required', 'string', 'max:40', 'alpha_dash',
                Rule::unique('promotions', 'code')->ignore($promotion),
            ],
            'discount_percent' => ['required', 'integer', 'min:1', 'max:100'],
            'starts_at' => ['nullable', 'date'],
            'ends_at' => ['nullable', 'date', 'after_or_equal:starts_at'],
            'is_active' => ['nullable', 'boolean'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge(['code' => strtoupper(trim((string) $this->input('code')))]);
    }

    public function attributes(): array
    {
        return [
            'code' => 'code promotionnel',
            'discount_percent' => 'réduction',
            'starts_at' => 'date de début',
            'ends_at' => 'date de fin',
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'Renseignez le champ « :attribute ».',
            'alpha_dash' => 'Le code ne peut contenir que des lettres, chiffres, tirets et underscores.',
            'unique' => 'Ce code promotionnel existe déjà.',
            'min.numeric' => 'La réduction doit être comprise entre 1 et 100 %.',
            'max.numeric' => 'La réduction doit être comprise entre 1 et 100 %.',
            'ends_at.after_or_equal' => 'La date de fin doit être postérieure ou égale à la date de début.',
        ];
    }
}

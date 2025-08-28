<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'price' => 'required|numeric|min:0',
            'img' => 'nullable|image|max:10240',
            'material' => 'required|string|max:255',
            'color' => 'required|string|max:100',
            'stock' => 'required|integer|min:1',
            'category_id' => 'required|exists:categories,id',
            'clothing_category_id' => 'required|exists:clothing_categories,id',
            'person_category_id' => 'required|exists:person_categories,id',
        ];
    }
}

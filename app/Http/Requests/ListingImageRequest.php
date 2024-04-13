<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ListingImageRequest extends FormRequest
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
            'images.*'=>'mimes:jpg,png,jpeg|max:5000'
        ];
    }

    public function messages(): array
    {
        return [
            'images.*.mimes'=>'The file should be 1 of the formats:jpg,png,jpeg',
        ];
    }
}

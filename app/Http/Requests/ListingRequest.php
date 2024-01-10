<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ListingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'beds'=>'required|integer|min:1|max:5',
            'baths'=>'required|integer|min:1|max:5',
            'area'=>'required|integer|min:10|max:50',
            'city'=>'required|min:3|max:20',
            'code'=>'required|min:3|max:20',
            'street'=>'required|min:3|max:20',
            'street_nr'=>'required|min:1',
            'price'=>'required|integer|min:1|max:10000',
        ];
    }
}

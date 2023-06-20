<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class AddRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'category' =>'required',
            'itemCode' => 'required|unique:products,item_code',
            'productName' => 'required',
            'price' => 'required',
            
        ];
    }
    /**
     * Rules custome message
     */

    public function messages(){
        return [
            'required' => "The :attribute field is required",
            'unique' => "This :attribute is already used. Please try another",
        ];
    }
}

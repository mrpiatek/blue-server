<?php

namespace MrPiatek\BlueServer\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class StoreProduct
 * Request used to create new product.
 *
 * @package App\Http\Requests
 */

class StoreOrUpdateProduct extends FormRequest
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
            'name' => 'required|string|max:255|min:1',
            'amount' => 'required|int|min:0'
        ];
    }
}

<?php

    namespace App\Http\Requests;

    use Illuminate\Foundation\Http\FormRequest;

    class SalesRequest extends FormRequest
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
                'client_id'  => 'required',
                'product_id' => 'required',
                'quantity'   => 'required',
                'unit_price' => 'required',
            ];
        }

        public function messages()
        {
            return [
                'client_id.required'  => 'Cliente Obrigatório',
                'product_id.required' => 'Produto Obrigatório',
                'quantity.required'   => 'Quantidade Obrigatório',
                'unit_price.required' => 'Preço Unitário Obrigatório',
            ];
        }
    }

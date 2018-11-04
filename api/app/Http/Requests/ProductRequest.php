<?php

    namespace App\Http\Requests;

    use Illuminate\Foundation\Http\FormRequest;

    class ProductRequest extends FormRequest
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
                'name'        => 'required|max:150',
                'description' => 'required|max:255',
            ];
        }

        public function messages()
        {
            return [
                'name.required'        => 'Nome Obrigatório',
                'name.max'             => 'Limite de caracteres é de 150',
                'description.required' => 'Descrição Obrigatório',
                'description.max'      => 'Limite de caracteres é de 255',
            ];
        }
    }

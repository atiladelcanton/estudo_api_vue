<?php

    namespace App\Http\Requests;

    use Illuminate\Foundation\Http\FormRequest;

    class ClientUpdateRequest extends FormRequest
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
                'name'         => 'required',
                'cep'          => 'required',
                'city'         => 'required',
                'state'        => 'required',
                'neighborhood' => 'required',
                'address'      => 'required',
                'email'        => 'required',
            ];
        }

        public function attributes()
        {
            return [
                'name.required' => 'Nome Obrigatório',
                'cep.required' => 'Cep Obrigatório',
                'city.required' => 'Cidade Obrigatório',
                'state.required' => 'Estado Obrigatório',
                'neighborhood.required' => 'Bairro Obrigatório',
                'address.required' => 'Endereço Obrigatório',
                'email.required' => 'E-mail Obrigatório'
            ];
        }
    }

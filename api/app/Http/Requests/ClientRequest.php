<?php

    namespace App\Http\Requests;

    use Illuminate\Foundation\Http\FormRequest;

    class ClientRequest extends FormRequest
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
                'name'         => 'required|max:150',
                'cep'          => 'required|max:12',
                'city'         => 'required|max:150',
                'state'        => 'required|max:2',
                'neighborhood' => 'required|max:200',
                'address'      => 'required|max:255',
                'email'        => 'required|unique:clients|max:100',
            ];
        }

        public function messages()
        {
            return [
                'name.required'         => 'Nome Obrigatório',
                'name.max'              => 'Limite de caracteres é de 150',
                'cep.required'          => 'Cep Obrigatório',
                'cep.max'               => 'Limite de caracteres é de 12',
                'city.required'         => 'Cidade Obrigatório',
                'city.max'              => 'Limite de caracteres é de 150',
                'state.required'        => 'Estado Obrigatório',
                'state.max'             => 'Limite de caracteres é de 2',
                'neighborhood.required' => 'Bairro Obrigatório',
                'neighborhood.max'      => 'Limite de caracteres é de 200',
                'address.required'      => 'Endereço Obrigatório',
                'address.max'           => 'Limite de caracteres é de 255',
                'email.required'        => 'E-mail Obrigatório',
                'email.unique' => 'Já existe esse e-mail cadastrado',
                'email.max'    => 'Limite de caracteres é de 100',
            ];
        }
    }

<?php

    namespace App\Http\Resources;

    use Illuminate\Http\Resources\Json\Resource;

    class ClientWithProducts extends Resource
    {
        /**
         * Transform the resource collection into an array.
         *
         * @param  \Illuminate\Http\Request $request
         *
         * @return array
         */
        public function toArray($request)
        {

                return [
                    'id'           => $this->id,
                    'name'         => $this->name,
                    'cep'          => $this->cep,
                    'city'         => $this->city,
                    'state'        => $this->state,
                    'neighborhood' => $this->neighborhood,
                    'address'      => $this->address,
                    'email'        => $this->email,
                    'products'     => new Product($this->products),
                ];
        }
    }

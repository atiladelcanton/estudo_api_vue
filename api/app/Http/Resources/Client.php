<?php

    namespace App\Http\Resources;

    use Illuminate\Http\Resources\Json\ResourceCollection;

    class Client extends ResourceCollection
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
                'data' => $this->collection->transform(function ($client) {
                    return [
                        'id'           => $client->id,
                        'name'         => $client->name,
                        'cep'          => $client->cep,
                        'city'         => $client->city,
                        'state'        => $client->state,
                        'neighborhood' => $client->neighborhood,
                        'address'      => $client->address,
                        'email'        => $client->email,
                    ];
                }),
            ];
        }
    }

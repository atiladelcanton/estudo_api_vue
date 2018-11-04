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
            return new Product($this->products);
        }
    }

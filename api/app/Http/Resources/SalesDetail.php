<?php

    namespace App\Http\Resources;

    use Illuminate\Http\Resources\Json\Resource;
    use Illuminate\Support\Facades\DB;


    class SalesDetail extends Resource
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
            $this->resource->load(['products']);

            return $this->resource->map(function ($item) {
                return [
                    'id'       => $item->id,
                    'name'     => $item->name,
                    'products' => new Product($item->products),
                    'total'    => $item->products()->sum('total'),
                    'qtd'      => $item->products()->count(),
                    'role' => $item->whenPivotLoaded('client_product')


                ];
            });
        }
    }

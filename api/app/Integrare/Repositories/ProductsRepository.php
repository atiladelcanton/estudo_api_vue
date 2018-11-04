<?php
    /**
     * Created by PhpStorm.
     * User: atilarampazo
     * Date: 03/11/2018
     * Time: 22:09
     */

    namespace App\Integrare\Repositories;



    use App\Integrare\Models\Product;

    class ProductsRepository extends EloquentRepository
    {
        /**
         * ClientRepository constructor.
         *
         * @param Product $product
         */
        public function __construct(Product $product)
        {
            parent::__construct($product);
        }

        /**
         * @return mixed
         */
        public function getAll()
        {
            return $this->model->get();
        }
    }
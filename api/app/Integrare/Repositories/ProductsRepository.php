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
         * @var Product
         */
        private $model;

        /**
         * AdministratorRepository constructor.
         *
         * @param Product $product
         */
        public function __construct(Product $product)
        {
            $this->model = $product;
        }

        /**
         * @return mixed
         */
        public function getAll()
        {
            return $this->model->get();
        }

        /**
         * @param $id
         *
         * @return mixed
         */
        public function getById($id)
        {
            return $this->model->find($id);
        }

        /**
         * @param $data
         *
         * @return mixed
         */
        public function create($data)
        {
            return $this->model->create($data);
        }

        /**
         * @param $id
         * @param $data
         *
         * @return mixed
         */
        public function update($id, $data)
        {
            return $this->model->find($id)->fill($data)->save();
        }

        /**
         * @param $id
         *
         * @return mixed
         */
        public function delete($id)
        {
            return $this->model->find($id)->delete();
        }
    }
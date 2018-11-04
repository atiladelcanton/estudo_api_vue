<?php
    /**
     * Created by PhpStorm.
     * User: atilarampazo
     * Date: 03/11/2018
     * Time: 22:12
     */

    namespace App\Integrare\Services;


    use App\Integrare\Contracts\ServiceContract;
    use App\Integrare\Repositories\ProductsRepository;

    class ProductService implements ServiceContract
    {

        private $productRepository;

        public function __construct(ProductsRepository $productRepository)
        {
            $this->productRepository = $productRepository;
        }

        /**
         * @return mixed
         */
        public function renderList()
        {
            return $this->productRepository->getAll();
        }

        /**
         * @param $id
         *
         * @return mixed
         */
        public function renderEdit($id)
        {
            return $this->productRepository->getById($id);
        }

        /**
         * @param $id
         * @param $data
         *
         * @return mixed
         */
        public function buildUpdate($id, $data)
        {
            return $this->buildUpdate($id, $data);
        }

        /**
         * @param $data
         *
         * @return mixed
         */
        public function buildInsert($data)
        {
            return $this->productRepository->create($data);
        }

        /**
         * @param $id
         *
         * @return mixed
         */
        public function buildDelete($id)
        {
            return $this->productRepository->delete($id);
        }
    }
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
         * @throws \Exception
         */
        public function renderEdit($id)
        {
            $this->exists($id);

            return $this->productRepository->getById($id);


        }

        /**
         * @param $id
         * @param $data
         *
         * @return mixed
         * @throws \Exception
         */
        public function buildUpdate($id, $data)
        {
            $this->exists($id);

            return $this->productRepository->update($id, $data);
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
         * @throws \Exception
         */
        public function buildDelete($id)
        {
            $this->exists($id);
            return $this->productRepository->delete($id);
        }

        /**
         * Validate the existence of the registry
         *
         * @param $id
         *
         * @throws \Exception
         */
        public function exists($id)
        {
            $product = $this->productRepository->getById($id);

            if (is_null($product)) {
                throw new \Exception('Registro não encontrado', 404);
            }
        }
    }
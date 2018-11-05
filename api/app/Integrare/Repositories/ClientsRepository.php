<?php
    /**
     * Created by PhpStorm.
     * User: atilarampazo
     * Date: 03/11/2018
     * Time: 22:09
     */

    namespace App\Integrare\Repositories;


    use App\Integrare\Models\Client;

    class ClientsRepository extends EloquentRepository
    {
        /**
         * ClientRepository constructor.
         *
         * @param Client $client
         */
        public function __construct(Client $client)
        {
            parent::__construct($client);
        }

        /**
         * @return mixed
         */
        public function getAll()
        {
            return $this->model->get();
        }

        public function getByIdWithProducts($id)
        {
            return $this->model->with('products')->where('id', $id)->first();
        }
        public function getWithProducts()
        {
            return $this->model->has('products')->orderBy('name')->get();
        }
    }
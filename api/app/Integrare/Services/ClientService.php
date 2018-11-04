<?php
    /**
     * Created by PhpStorm.
     * User: atilarampazo
     * Date: 03/11/2018
     * Time: 22:12
     */

    namespace App\Integrare\Services;


    use App\Http\Resources\Client;
    use App\Integrare\Contracts\ServiceContract;
    use App\Integrare\Repositories\ClientsRepository;

    class ClientService implements ServiceContract
    {

        private $clientRepository;

        public function __construct(ClientsRepository $clientRepository)
        {
            $this->clientRepository = $clientRepository;
        }

        /**
         * @return mixed
         */
        public function renderList()
        {
            return $this->clientRepository->getAll();
        }

        /**
         * @param $id
         *
         * @return mixed
         */
        public function renderEdit($id)
        {
            return $this->clientRepository->getById($id);
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
            return $this->clientRepository->create($data);
        }

        /**
         * @param $id
         *
         * @return mixed
         */
        public function buildDelete($id)
        {
            return $this->clientRepository->delete($id);
        }

        public function renderWithRelationshipProduct($id){
            return new Client($this->clientRepository->getByIdWithProducts($id));
        }
    }
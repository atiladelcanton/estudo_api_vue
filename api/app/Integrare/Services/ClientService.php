<?php


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
         * @throws \Exception
         */
        public function renderEdit($id)
        {
            $this->exists($id);
            return $this->clientRepository->getById($id);
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

            return $this->clientRepository->update($id, $data);
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
         * @throws \Exception
         */
        public function buildDelete($id)
        {
            $this->exists($id);
            return $this->clientRepository->delete($id);
        }

        /**
         * @param null $id
         *
         * @return ClientsRepository|\Illuminate\Database\Eloquent\Model|null|object
         */
        public function renderWithRelationshipProduct($id = null)
        {
            if (!is_null($id)) {
                return $this->clientRepository->getByIdWithProducts($id);
            }

            return $this->clientRepository->getWithProducts();
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
            $product = $this->clientRepository->getById($id);

            if (is_null($product)) {
                throw new \Exception('Registro não encontrado', 404);
            }
        }

        /**
         * @param $data
         *
         * @return mixed
         */
        public function buildInsertPivot($data)
        {

            $client = $this->clientRepository->getById($data['client_id']);

            $data['total'] = intval($data['quantity'])
                * floatval($data['unit_price']);
            $data['date'] = today()->toDateString();

            return $client->products()->attach($data['product_id'], $data);
        }
    }
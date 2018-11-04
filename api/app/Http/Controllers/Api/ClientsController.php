<?php

    namespace App\Http\Controllers\Api;

    use App\Http\Controllers\Controller;
    use App\Http\Resources\Client;
    use App\Http\Resources\ClientWithProducts;
    use App\Integrare\Services\ClientService;
    use Illuminate\Http\Request;

    class ClientsController extends Controller
    {
        protected $clientService;

        /**
         * ClientsController constructor.
         *
         * @param ClientService $clientService
         */
        public function __construct(ClientService $clientService)
        {
            $this->clientService = $clientService;
        }

        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function index()
        {
            return new Client($this->clientService->renderList());
        }


        /**
         * Store a newly created resource in storage.
         *
         * @param  \Illuminate\Http\Request $request
         *
         * @return \Illuminate\Http\Response
         */
        public function store(Request $request)
        {
            //
        }

        /**
         * Display the specified resource.
         *
         * @param  int $id
         *
         * @return \Illuminate\Http\Response
         */
        public function show($id)
        {
            //
        }


        /**
         * Update the specified resource in storage.
         *
         * @param  \Illuminate\Http\Request $request
         * @param  int                      $id
         *
         * @return \Illuminate\Http\Response
         */
        public function update(Request $request, $id)
        {
            //
        }

        /**
         * Remove the specified resource from storage.
         *
         * @param  int $id
         *
         * @return \Illuminate\Http\Response
         */
        public function destroy($id)
        {
            //
        }

        /**
         * @param $client_id
         *
         * @return ClientWithProducts
         */
        public function clientsProducts($client_id)
        {
            return new ClientWithProducts($this->clientService->renderEdit($client_id));
        }
    }


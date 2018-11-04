<?php

    namespace App\Http\Controllers\Api;

    use App\Http\Controllers\Controller;
    use App\Http\Requests\ClientRequest;
    use App\Http\Requests\ClientUpdateRequest;
    use App\Http\Resources\Client;
    use App\Http\Resources\ClientWithProducts;
    use App\Integrare\Services\ClientService;


    class ClientsController extends Controller
    {
        protected $clientService;

        /**
         * ClientsController constructor.
         *
         * @api
         *
         * @param ClientService $clientService
         */
        public function __construct(ClientService $clientService)
        {
            $this->clientService = $clientService;
        }

        /**
         *
         * @api {get} /clients Request all Clients
         * @return Client
         */
        public function index()
        {
            return new Client($this->clientService->renderList());
        }


        /**
         *
         *
         * @api {post} /clients Store a new client in database
         *
         * @param ClientRequest $request
         *
         * @return \Illuminate\Http\JsonResponse
         */
        public function store(ClientRequest $request)
        {
            try {
                $client = $this->clientService->buildInsert($request->input());

                return response()->json(['data' => $client], 201);
            } catch (\Exception $exception) {
                return response()->json([$exception->getMessage()],
                    500);
            }
        }

        /**
         *
         *
         * @api {get} /clients/:id Return specific client
         *
         * @param $id
         *
         * @return \Illuminate\Http\JsonResponse
         */
        public function show($id)
        {
            try {
                return response()->json(['data' => $this->clientService->renderEdit($id)],
                    200);
            } catch (\Exception $e) {
                return response()->json(['data' => $e->getMessage()],
                    $e->getCode());
            }
        }


        /**
         *
         * @api {put} /clients/:id Update informations of specific client
         *
         * @param ClientUpdateRequest $request
         * @param                     $id
         *
         * @return \Illuminate\Http\JsonResponse
         */
        public function update(ClientUpdateRequest $request, $id)
        {
            try {


                $this->clientService->buildUpdate($id,$request->input());
                $client = $this->clientService->renderEdit($id);

                return response()->json(['data' => $client],
                    200);

            } catch (\Exception $e) {
                \Log::error(
                    $e->getMessage(),
                    [
                        'linha'   => $e->getLine(),
                        'arquivo' => $e->getFile(),
                    ]
                );

                return response()->json([$e->getMessage()],
                    $e->getCode());
            }
        }

        /**
         *
         *
         * @api {delete} /clients/:id Remove the specified resource from storage.
         *
         * @param  int $id
         *
         * @return \Illuminate\Http\Response
         */
        public function destroy($id)
        {
            try {
                $this->clientService->buildDelete($id);

                return response()->json(['data' => 'Usuário Removido'], 200);
            } catch (\Exception $e) {
                \Log::error(
                    $e->getMessage(),
                    [
                        'linha'   => $e->getLine(),
                        'arquivo' => $e->getFile(),
                    ]
                );

                return response()->json([$e->getMessage()],
                    500);
            }
        }

        /**
         * @param $client_id
         *
         * @return ClientWithProducts
         * @throws \Exception
         */
        public function clientsProducts($client_id)
        {
            $client = $this->clientService->renderEdit($client_id);

            return new ClientWithProducts($client);
        }
    }


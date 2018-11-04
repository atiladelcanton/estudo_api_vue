<?php

    namespace App\Http\Controllers\Api;

    use App\Http\Controllers\Controller;
    use App\Http\Requests\ClientRequest;
    use App\Http\Requests\ClientUpdateRequest;
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
        public function store(ClientRequest $request)
        {
            try {
                $client = $this->clientService->buildInsert($request->input());

                return response()->json($client,201);
            } catch (Exception $exception) {
                return response()->json(['data' => $exception->getMessage()],
                    500);
            }
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
            return response()->json(['data' => $this->clientService->renderEdit($id)],200);
        }


        /**
         * @param ClientUpdateRequest $request
         * @param                     $id
         *
         * @return \Illuminate\Http\JsonResponse
         */
        public function update(Request $request, $id)
        {
            try {
                dd($request->input());
                $this->clientService->buildUpdate($id,$request->input());
                $client = $this->clientService->renderEdit($id);
                return response()->json($client,200);
            } catch (Exception $exception) {
                return response()->json(['data' => $exception->getMessage()],
                    500);
            }
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


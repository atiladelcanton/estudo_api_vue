<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SalesRequest;
use App\Http\Resources\ClientWithProducts;
use App\Http\Resources\Sales;
use App\Http\Resources\SalesDetail;
use App\Integrare\Services\ClientService;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    protected $clientService;

    public function __construct(ClientService $clientService)
    {
        $this->clientService = $clientService;
    }

    /**
     * @api {get} /sales Return all register in pivot table
     * @return Sales
     */
    public function index()
    {
        $client = $this->clientService->renderWithRelationshipProduct();

        return new Sales($client);
    }


    /**
     * @param SalesRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(SalesRequest $request)
    {
        try {

            $this->clientService->buildInsertPivot($request->all());

            return response()->json(['data' => $this->clientService->renderWithRelationshipProduct($request->input('client_id'))],
                201);

        } catch (\Illuminate\Database\QueryException $queryException) {
            \Log::error(
                $queryException->getMessage(),
                [
                    'linha'   => $queryException->getLine(),
                    'arquivo' => $queryException->getFile(),
                ]
            );
            if ($queryException->getCode() == '23000') {
                return response()->json(['Produto já vinculado ao cliente'],
                    500);
            }
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $client = $this->clientService->renderWithRelationshipProduct($id);

            return response()->json(['data' => $client], 200);
        } catch (\Exception $e) {

        }
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($client_id, $product_id)
    {
        try {

            $client = $this->clientService->renderEdit($client_id);
            $client->products()->detach($product_id);

            return response()->json(['data' => 'Registro removido com sucesso'],
                200);
        } catch (\Exception $e) {

        }
    }
}

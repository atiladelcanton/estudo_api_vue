<?php

    namespace App\Http\Controllers\Api;

    use App\Http\Controllers\Controller;
    use App\Http\Requests\ProductRequest;
    use App\Http\Resources\Product;
    use App\Integrare\Services\ProductService;
    use Illuminate\Http\Request;

    class ProductsController extends Controller
    {
        protected $productsService;

        public function __construct(
            ProductService $productService
        )
        {
            $this->productsService = $productService;
        }

        /**
         * @api {get} /products/:id Request all Products
         * @return Product
         */
        public function index()
        {
            return new Product($this->productsService->renderList());
        }


        /**
         * @api {post} /products Store a new product in database
         *
         * @param ProductRequest $request
         *
         * @return \Illuminate\Http\JsonResponse
         */
        public function store(ProductRequest $request)
        {
            try {

                $product
                    = $this->productsService->buildInsert($request->input());

                return response()->json(['data' => $product], 201);
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
         * @api {get} /products/:id Request Product information
         *
         * @param $id
         *
         * @return \Illuminate\Http\JsonResponse
         */
        public function show($id)
        {
            try {
                return response()->json(['data' => $this->productsService->renderEdit($id)],
                    200);
            } catch (\Exception $e) {
                return response()->json(['data' => $e->getMessage()],
                    $e->getCode());
            }
        }


        /**
         * @api {put} /products/:id Update the specified product
         *
         * @param ProductRequest $request
         * @param                $id
         *
         * @return \Illuminate\Http\JsonResponse
         */
        public function update(ProductRequest $request, $id)
        {
            try {

                $this->productsService->buildUpdate($id, $request->input());
                $product = $this->productsService->renderEdit($id);

                return response()->json(['data' => $product],
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
         * Remove the specified resource from storage.
         *
         * @param  int $id
         *
         * @return \Illuminate\Http\Response
         */
        public function destroy($id)
        {
            try {

                $this->productsService->buildDelete($id);

                return response()->json(['data' => 'Produto Removido'], 200);
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
    }

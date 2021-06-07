<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Services\ProductService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /** @var ProductService */
    private $service;

    public function __construct(ProductService $service)
    {
        return $this->service = $service;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notes = $this->service->getAll(true, null, null)
            ->with('user')
            ->orderBy('id', 'DESC')
            ->paginate(env('APP_PAGINATE'));

        return compact('products');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), Product::$rules);

            if ($validator->fails()) {
                return $this->error($validator->errors());
            }

            $this->service->store($request);

            return $this->success('Produto criado com sucesso');
        } catch (Exception $e) {
            logger()->error('Log', [
                'erro' => $e,
                'exception' => $e->getMessage()
            ]);

            return $this->error('N?o foi possível fazer o upload da imagem, tente mais tarde');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            return $this->service->findByID($id);
        } catch (Exception $e) {
            logger()->error('Log', [
                'erro' => $e,
                'exception' => $e->getMessage()
            ]);

            return $this->error('N?o foi encontrar produto, tente mais tarde');
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        try {

            $validator = Validator::make($request->all(), Product::$rules);

            if ($validator->fails()) {
                return $this->error($validator->errors());
            }

            $this->service->update($request, $id);

            return $this->success('Produto atualizada com sucesso');
        } catch (Exception $e) {
            logger()->error('Log', [
                'erro' => $e,
                'exception' => $e->getMessage()
            ]);

            return $this->error('N?o foi possível atualizar o registro, tente mais tarde');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {

            return $this->service->destroy($id);
        } catch (Exception $e) {
            logger()->error('Log', [
                'erro' => $e,
                'exception' => $e->getMessage()
            ]);

            return $this->internalError('N?o foi possível deletar o registro, tente mais tarde');
        }
    }
}

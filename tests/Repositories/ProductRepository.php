<?php

namespace Tests\Feature\Controllers;

use App\Http\Api\Controllers\ProductController;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductControllerTest extends TestCase
{

    use DatabaseTransactions;

    /**
     * Service
     *     
     */
    public function service()
    {
        return app(ProductController::class);
    }
    
     /**
     * Teste create method
     *
     * @group product
     * @return void
     */
    public function testProductControllerStore()
    {
        $user = User::first();
        auth()->login($user);        
        $request = request();        
        $request['name'] = 'Meu conteudo';
        $response = $this->service()->store($request);
        $response = json_encode($response);
        $response = json_decode($response);
        $this->assertEquals($response->original->status, 200);
    }

     /**
     * Teste show method
     *
     * @group product
     * @return void
     */
    public function testProductControllerShow()
    {
        $user = User::first();
        auth()->login($user);
        $product = Product::first();
        $response = $this->service()->show($product->uuid);
        $response = json_encode($response);
        $response = json_decode($response);
        $this->assertEquals($response->original->status, 200);
    }

     /**
     * Teste update method
     *
     * @group product
     * @return void
     */
    public function testProductControllerUpdate()
    {
        $user = User::first();
        auth()->login($user);
        $request = request();
        $product = Product::first();
        $request['name'] = 'Meu conteudo da produto';
        $response = $this->service()->update($request, $product->uuid);
        $response = json_encode($response);
        $response = json_decode($response);
        $this->assertEquals($response->original->status, 200);
    }

     /**
     * Teste destroy method
     *
     * @group product
     * @return void
     */
    public function testProductControllerDestroy()
    {
        $user = User::first();
        auth()->login($user);        
        $product = Product::first();        
        $response = $this->service()->destroy($product->uuid);
        $response = json_encode($response);
        $response = json_decode($response);
        $this->assertEquals($response->original->status, 200);
    }
}

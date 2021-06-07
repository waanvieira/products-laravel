<?php

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            'name' => 'Produto',
            'user_id' => User::first()->id,
            'description' => 'Produto teste'            
        ]);
    }
}

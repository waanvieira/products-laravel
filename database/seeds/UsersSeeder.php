<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Dev',
            'email' => 'userdev@dev.com.br',
            'password' => bcrypt(123456)
        ]);
    }
}

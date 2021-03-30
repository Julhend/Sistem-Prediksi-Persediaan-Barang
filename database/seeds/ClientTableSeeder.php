<?php

use Illuminate\Database\Seeder;

class ClientTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Client::create([
            'client_name' => 'Robert',
            'phone' => '0000000000',
            'address' => 'Kijang',
            'description' => 'Nothing'
        ]);
    }
}
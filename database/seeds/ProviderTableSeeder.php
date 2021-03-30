<?php

use Illuminate\Database\Seeder;

class ProviderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Provider::create([
            'provider_name' => 'CV.ROBERT',
            'phone' => '0000000000',
            'address' => 'Tanjung Pinang',
            'description' => 'Nothing'
        ]);
    }
}
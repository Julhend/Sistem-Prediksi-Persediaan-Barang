<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class GeneralSettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\GeneralSetting::create([
            'store_name' => 'Toko Harapan Baru',
            'Description' => 'Sistem Prediksi Persediaan Barang',
            'phone' => '01234566',
            'address' => 'Tanjung Uban',
            'start_day' => Carbon::parse('2021-06-17'),
            'image' => 'logo_default.png'
        ]);
    }
}
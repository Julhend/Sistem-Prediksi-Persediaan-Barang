<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePredictionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('predictions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('max_product_masuk');
            $table->integer('max_product_keluar');
            $table->integer('persediaan');
            $table->integer('permintaan');
            $table->integer('persediaan');
            $table->double('permintaan_tertinggi');
            $table->double('persediaan_tertinggi');
            $table->double('pembelian_tertinggi');
            $table->double('permintaan_terendah');
            $table->double('persediaan_terendah');
            $table->double('pembelian_terendah');
            $table->double('permintaan_sedikit');
            $table->double('permintaan_banyak');
            $table->double('penjualan_turun');
            $table->double('penjualan_naik');
            $table->double('hasil_rules_satu');
            $table->double('hasil_rules_dua');
            $table->double('hasil_rules_tiga');
            $table->double('hasil_rules_empat');
            $table->double('defuzifikasi');
            $table->string('kesimpulan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('predictions');
    }
}

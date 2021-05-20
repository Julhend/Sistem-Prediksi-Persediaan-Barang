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
            $table->integer('product_id')->unsigned()->nullable();
            $table->integer('input_persediaan')->nullable();
            $table->integer('input_permintaan')->nullable();
            $table->integer('input_pembelian')->nullable();
            $table->double('permintaan_terendah')->nullable();
            $table->double('permintaan_tertinggi')->nullable();
            $table->double('persediaan_terendah')->nullable();
            $table->double('persediaan_tertinggi')->nullable();
            $table->double('pembelian_terendah')->nullable();
            $table->double('pembelian_tertinggi')->nullable();
            $table->double('hasil_rules_satu')->nullable();
            $table->double('hasil_rules_dua')->nullable();
            $table->double('hasil_rules_tiga')->nullable();
            $table->double('hasil_rules_empat')->nullable();
            $table->double('defuzifikasi')->nullable();
            $table->string('kesimpulan')->nullable();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
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

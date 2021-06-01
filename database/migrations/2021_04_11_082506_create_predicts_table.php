<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePredictsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('predicts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->unsigned()->nullable();
            $table->string('product_name')->nullable();
            $table->integer('input_persediaan')->nullable();
            $table->integer('input_permintaan')->nullable();
            $table->double('permintaan_rendah')->nullable();
            $table->double('permintaan_tinggi')->nullable();
            $table->double('persediaan_sedikit')->nullable();
            $table->double('persediaan_banyak')->nullable();
            $table->double('pembelian_berkurang')->nullable();
            $table->double('pembelian_bertambah')->nullable();
            $table->double('rules_satu')->nullable();
            $table->double('rules_dua')->nullable();
            $table->double('rules_tiga')->nullable();
            $table->double('rules_empat')->nullable();
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
        Schema::dropIfExists('predicts');
    }
}

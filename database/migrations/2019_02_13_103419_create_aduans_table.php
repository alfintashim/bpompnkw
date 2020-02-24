<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAduansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aduans', function (Blueprint $table) {
            $table->increments('id');
            $table->string('status');
            $table->unsignedInteger('id_user')->index();
            // $table->enum('jenis_produk', 
            // [
            //     'Obat', 
            //     'Alkes', 
            //     'PKRT', 
            //     'Makanan-Minuman', 
            //     'Obat Tradisional', 
            //     'Kosmetik', 
            //     'Suplemen Makanan', 
            //     'Bahan Berbahaya', 
            //     'Info Umum'
            // ])
            // ->default('Obat');
            $table->string('jenis_produk')->default('Obat');
            $table->string('nama_produk');
            $table->string('no_reg')->nullable();
            $table->date('tgl_exp')->nullable();
            $table->string('nama_pabrik')->nullable();
            $table->string('alamat_pabrik')->nullable();
            $table->string('no_batch')->nullable();
            $table->double('lat');
            $table->double('lng');
            $table->string('alamat_beli');
            $table->date('tgl_guna')->nullable();
            $table->string('info_lain')->nullable();
            $table->string('isi');
            $table->string('file');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aduans');
    }
}

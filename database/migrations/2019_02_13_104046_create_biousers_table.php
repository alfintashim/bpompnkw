<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBiousersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('biousers', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_user')->index();
            $table->enum('jk', ['Laki-Laki', 'Perempuan'])->default('Laki-Laki');
            $table->string('alamat')->nullable();
            $table->string('profesi')->nullable();
            $table->string('instansi')->nullable();
            $table->string('no_hp')->nullable();
            $table->string('no_ktp')->nullable();
            $table->string('ktp')->nullable();
            $table->string('foto')->nullable();
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
        Schema::dropIfExists('biousers');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogAduansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_aduans', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_aduan')->index();
            $table->string('status');
            $table->enum('bidang', [
                'Bidang Pengujian', 
                'Bidang Pemeriksaan', 
                'Bidang Penindakan',
                'Bidang Informasi dan Komunikasi',
                'Bagian Tata Usaha'
            ])
            ->nullable();
            $table->string('note_disposisi')->nullable();
            $table->string('jawaban')->nullable();
            $table->unsignedInteger('id_create')->index();
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
        Schema::dropIfExists('log_aduans');
    }
}

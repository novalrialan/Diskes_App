<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengelolaanAngaranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengelolaan_angaran', function (Blueprint $table) {
            $table->id();
            $table->mediumText('kode_rekening')->nullable()->default(0);
            $table->text('keterangan')->nullable()->default(0);
            $table->string('perihal_persub_kegiatan')->default(0);
            $table->string('anggaran')->nullable()->default(0);
            $table->mediumText('waktu')->nullable()->default(0);
            $table->string('biaya', 100)->nullable()->default(0);
            $table->string('total', 100)->nullable()->default(0);
            $table->string('saldo', 100)->nullable()->default(0);
            $table->string('penangung_jawab', 150)->nullable()->default('not name');
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
        Schema::dropIfExists('pengelolaan_angaran');
    }
}
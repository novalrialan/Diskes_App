<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldStatusToVerifikasiBerkas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('verifikasi_berkas', function (Blueprint $table) {
            $table->tinyInteger('status')->default(0)->after('tanggal_verifikasi');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('verifikasi_berkas', function (Blueprint $table) {
            $table->tinyInteger('status')->default(0)->after('tanggal_verifikasi');
        });
    }
}
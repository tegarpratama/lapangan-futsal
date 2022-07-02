<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToLapanganFutsalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lapangan_futsal', function (Blueprint $table) {
            $table->text('gambar')->nullable();
            $table->integer('harga')->nullable();
            $table->text('jam_operasional')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lapangan_futsal', function (Blueprint $table) {
            $table->dropColumn('gambar');
            $table->dropColumn('harga');
            $table->dropColumn('jam_operasional');
        });
    }
}

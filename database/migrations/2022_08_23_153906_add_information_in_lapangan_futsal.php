<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddInformationInLapanganFutsal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lapangan_futsal', function (Blueprint $table) {
            $table->text('fasilitas')->default(null);
            $table->text('kontak')->default(null);
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
            $table->dropColumn('fasilitas');
            $table->dropColumn('kontak');
            $table->dropColumn('gambar');
        });
    }
}

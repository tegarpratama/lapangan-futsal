<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLapanganFutsalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lapangan_futsal', function (Blueprint $table) {
            $table->id();
            $table->string('place_id');
            $table->string('nama', 100);
            $table->decimal('rating', 5,1)->default(0.0);
            $table->integer('user_ratings_total')->default(0);
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->text('alamat');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lapangan_futsal');
    }
}

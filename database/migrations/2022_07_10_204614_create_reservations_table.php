<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->char('room_id', 36);
            $table->char('reservation_id', 36)->primary();
            $table->string('summary', 256);
            $table->dateTime('start_at');
            $table->dateTime('end_at');
            $table->string('note', 1024);
            $table->timestamps();

            $table->foreign('room_id')->references('room_id')->on('rooms')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservations');
    }
};

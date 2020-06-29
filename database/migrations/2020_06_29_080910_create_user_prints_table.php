<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserPrintsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_prints', function (Blueprint $table) {
            $table->string('id');
            $table->string('server');
            $table->string('user');
            $table->string('address');
            $table->string('mac_address');
            $table->string('login_by');
            $table->string('uptime');
            $table->string('idle_time');
            $table->string('idle_timeout');
            $table->string('byte_in');
            $table->string('byte_out');
            $table->string('packet_in');
            $table->string('packet_out');
            $table->string('radius');
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
        Schema::dropIfExists('user_prints');
    }
}

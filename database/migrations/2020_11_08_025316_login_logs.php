<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class LoginLogs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('login_logs', function (Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('device_name');
            $table->string('browser_name');
            $table->string('ip_addr');
            $table->string('version');
            $table->timestamps();
            $table->string('good_day');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}

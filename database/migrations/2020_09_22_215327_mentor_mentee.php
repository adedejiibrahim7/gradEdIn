<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MentorMentee extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mentor_mentee', function (Blueprint $table){
           $table->id();
           $table->unsignedBigInteger('mentor');
           $table->foreign('mentor')->references('id')->on('users')->onDelete('cascade');
           $table->unsignedBigInteger('mentee');
           $table->foreign('mentor')->references('id')->on('users')->onDelete('cascade');
           $table->string('status')->default("not-follows"); //Given that a mentor has to accept
           $table->timestamps();
           $table->softDeletes();
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

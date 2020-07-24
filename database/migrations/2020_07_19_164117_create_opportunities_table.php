<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOpportunitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('opportunities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('title');
            $table->longText('description');
            $table->string('link')->nullable();
            $table->string('media')->nullable();
            $table->enum('status', ['pending', 'active'])->default('pending');
            $table->timestamp('open')->nullable();
            $table->timestamp('close')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->boolean('take_app')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('opportunities');
        Schema::enableForeignKeyConstraints();

    }
}

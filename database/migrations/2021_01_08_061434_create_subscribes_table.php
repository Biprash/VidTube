<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscribesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscribes', function (Blueprint $table) {
            // $table->primary(['subscriber_user_id', 'subscribed_user_id']);
            $table->id();
            $table->unsignedBigInteger('subscriber_user_id');
            $table->unsignedBigInteger('subscribed_user_id');
            $table->timestamps();

            $table->foreign('subscriber_user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('subscribed_user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subscribes');
    }
}

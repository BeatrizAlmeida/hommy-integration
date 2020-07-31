<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RepublicUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('republic_users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('republic_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
        });

    Schema::table('republic_users', function (Blueprint $table) {
        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        $table->foreign('republic_id')->references('id')->on('republics')->onDelete('cascade');
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

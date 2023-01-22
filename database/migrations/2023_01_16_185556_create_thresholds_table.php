<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('thresholds', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users');
            $table->foreignId('basic_threshold_id')->nullable()->default(null)->references('id')->on('products');
            $table->foreignId('pro_threshold_id')->nullable()->default(null)->references('id')->on('products');
            $table->integer('basic_threshold_limit')->default(50);
            $table->integer('pro_threshold_limit')->default(500);
            $table->integer('api_calls_count')->default(0);
            $table->integer('api_calls_limit')->default(10000);
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
        Schema::dropIfExists('thresholds');
    }
};

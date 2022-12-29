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
        Schema::create('product_infos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('language_id')->references('id')->on('languages');
            $table->foreignId('product_id')->references('id')->on('products');
            $table->foreignId('user_id')->references('id')->on('users');
            $table->string('hash')->nullable()->default(null);
            $table->longText('content')->nullable()->default(null);
            $table->boolean('default')->default(false);
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
        Schema::dropIfExists('product_infos');
    }
};

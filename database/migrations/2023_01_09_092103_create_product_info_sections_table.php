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
        Schema::create('product_info_sections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_info_id')->references('id')->on('product_infos');
            $table->foreignId('user_id')->references('id')->on('users');
            $table->string('hash')->nullable()->default(null);
            $table->string('title');
            $table->longText('content')->nullable()->default(null);
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
        Schema::dropIfExists('product_info_sections');
    }
};

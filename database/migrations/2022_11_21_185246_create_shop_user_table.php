<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('shop_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('shop_id')->constrained();
            $table->unsignedInteger('number')->default('1');
            $table->string('material');
            $table->tinyInteger('size');
            $table->string('status')->default('in_cart');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('shop_user');
    }
};

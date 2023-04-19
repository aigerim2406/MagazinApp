<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('cart_shop', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('shop_id')->constrained();
            $table->boolean('cart');
        });
    }

    public function down()
    {
        Schema::dropIfExists('cart_shop');
    }
};

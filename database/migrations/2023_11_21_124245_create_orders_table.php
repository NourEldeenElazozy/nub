<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user');
            $table->unsignedBigInteger('product');
            $table->unsignedBigInteger('delivery')->nullable();
            $table->integer('status_user')->default(0);
            $table->integer('count')->default(0);
            $table->foreign('user')
            ->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('product')
            ->references('id')->on('products')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('delivery')
            ->references('id')->on('delivery_mans')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};

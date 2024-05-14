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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('section');
            $table->string('category');
            $table->string('video')->nullable();
            $table->longText('color1')->nullable();
            $table->longText('color2')->nullable();
            $table->longText('color3')->nullable();
            $table->longText('color4')->nullable();
            $table->longText('desc');
            $table->float('price');
            $table->float('price2')->default(0);
            $table->integer('count');
            $table->foreign('section')
                ->references('id')->on('sections')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('type')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};

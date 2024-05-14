<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCreditsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('credits', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sender_id');
            $table->foreign('sender_id')->references('id')->on('senders');
            $table->string('credit_number');
            $table->string('importer_name');
            $table->date('issue_date');
            $table->decimal('credit_amount', 10, 2);
            $table->unsignedBigInteger('currency_id');
            $table->foreign('currency_id')->references('id')->on('currency');
            $table->date('expiry_date');
            $table->string('account_number');
            $table->string('authorized_by');
            $table->string('goods_origin');
            $table->text('purpose_of_transfer');
            $table->text('manufacturing_statement');
            $table->string('financing_method');
            $table->string('beneficiary_name');
            $table->string('credit_status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('credits');
    }
};

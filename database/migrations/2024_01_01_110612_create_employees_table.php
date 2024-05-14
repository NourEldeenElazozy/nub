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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('national_id')->unique();
            $table->string('educational_qualification');
            $table->string('financial_number')->unique();
            $table->string('job_title');
            $table->decimal('current_allowance', 8, 2);
            $table->date('employment_start_date');
            $table->date('appointment_date');
            $table->unsignedBigInteger('bank_id');
            $table->string('account_number');
            $table->unsignedBigInteger('department_id');
            $table->string('position');
            $table->string('status');
            $table->date('birth_date');
            $table->string('id_proof')->nullable();
            $table->timestamps();
    
            $table->foreign('bank_id')->references('id')->on('banks');
            $table->foreign('department_id')->references('id')->on('departments');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};

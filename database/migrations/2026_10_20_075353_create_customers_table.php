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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained()->restrictOnDelete();
            $table->string('name');
            $table->string('vat_number', 20)->nullable();
            $table->string('tax_office')->nullable();
            $table->char('country', 2)->default('GR');
            $table->string('street')->nullable();
            $table->string('street_number', 10)->nullable();
            $table->string('postal_code', 10)->nullable();
            $table->string('city')->nullable();
            $table->string('email')->nullable();
            $table->string('phone', 30)->nullable();
            $table->timestamps();

            $table->unique(['company_id', 'vat_number']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};

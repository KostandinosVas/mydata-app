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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained()->restrictOnDelete();
            $table->foreignId('invoice_series_id')->constrained()->restrictOnDelete();
            $table->foreignId('customer_id')->nullable()->constrained()->restrictOnDelete();
            $table->foreignId('correlated_invoice_id')->nullable()->constrained('invoices')->restrictOnDelete();

            $table->string('invoice_type', 5);
            $table->string('status', 20)->default('draft');
            $table->unsignedInteger('number')->nullable();
            $table->unsignedSmallInteger('branch')->default(0);
            $table->date('issued_at')->nullable();
            $table->unsignedTinyInteger('payment_method');

            $table->decimal('net_total', 12, 2)->default(0);
            $table->decimal('vat_total', 12, 2)->default(0);
            $table->decimal('gross_total', 12, 2)->default(0);

            $table->string('mark', 30)->nullable();
            $table->string('uid', 64)->nullable();
            $table->text('qr_url')->nullable();

            $table->timestamps();

            $table->unique(['invoice_series_id', 'number']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};

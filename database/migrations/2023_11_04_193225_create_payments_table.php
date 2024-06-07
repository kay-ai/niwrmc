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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('invoice_id')->constrained()->cascadeOnDelete();
            $table->string('transaction_id');
            $table->string('amount_paid');
            $table->string('purpose');
            $table->string('application_id');
            $table->string('license_type');
            $table->enum('status', ['verified','unverified'])->default('unverified');
            $table->timestamps();
        });

        Schema::table('invoices', function (Blueprint $table) {
            $table->string('remita_rrr')->after('id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};

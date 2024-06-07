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
        Schema::table('license_sub_categories', function (Blueprint $table) {
            $table->decimal('processing_fee', 10,2)->nullable();
            $table->decimal('licensing_fee', 10,2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('license_sub_categories', function (Blueprint $table) {
            //
        });
    }
};

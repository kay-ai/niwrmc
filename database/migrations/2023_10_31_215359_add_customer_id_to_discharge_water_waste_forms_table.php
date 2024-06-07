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
        Schema::table('discharge_water_waste_forms', function (Blueprint $table) {
            $table->foreignId('customer_id')->after('id')->constrained()->cascadeOnDelete();
        });
        Schema::table('amendment_of_license_forms', function (Blueprint $table) {
            $table->foreignId('customer_id')->after('id')->constrained()->cascadeOnDelete();
        });
        Schema::table('bore_hole_contractor_license_forms', function (Blueprint $table) {
            $table->foreignId('customer_id')->after('id')->constrained()->cascadeOnDelete();
        });
        Schema::table('drillers_license_forms', function (Blueprint $table) {
            $table->foreignId('customer_id')->after('id')->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('discharge_water_waste_forms', function (Blueprint $table) {
            $table->dropColumn('customer_id');
        });
        Schema::table('amendment_of_license_forms', function (Blueprint $table) {
            $table->dropColumn('customer_id');
        });
        Schema::table('bore_hole_contractor_license_forms', function (Blueprint $table) {
            $table->dropColumn('customer_id');
        });
        Schema::table('drillers_license_forms', function (Blueprint $table) {
            $table->dropColumn('customer_id');
        });
    }
};

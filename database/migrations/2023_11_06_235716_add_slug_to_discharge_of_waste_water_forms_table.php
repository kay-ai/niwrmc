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
            $table->string('application_slug')->after('stage')->default('discharge-of-waste');
        });
        Schema::table('bore_hole_contractor_license_forms', function (Blueprint $table) {
            $table->string('application_slug')->after('stage')->default('bore-hole-contractor');
        });
        Schema::table('drillers_license_forms', function (Blueprint $table) {
            $table->string('application_slug')->after('stage')->default('drillers-license');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('discharge_water_waste_forms', function (Blueprint $table) {
            $table->dropColumn('application_slug');
        });
        Schema::table('bore_hole_contractor_license_forms', function (Blueprint $table) {
            $table->dropColumn('application_slug');
        });
        Schema::table('drillers_license_forms', function (Blueprint $table) {
            $table->dropColumn('application_slug');
        });
    }
};

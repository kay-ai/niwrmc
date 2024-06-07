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
        Schema::create('bore_hole_contractor_license_forms', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('contact_address');
            $table->string('occupation');
            $table->string('nature_of_business');
            $table->string('contract_description');
            $table->string('contract_value');
            $table->string('contract_location');
            $table->string('contract_client');
            $table->string('contract_date_execution');
            $table->string('referee_name');
            $table->string('referee_address');
            $table->string('type_of_drilling_equipment');
            $table->string('maximum_drilling_depth');
            $table->string('pumping_test_facilities');
            $table->string('large_test_facilities');
            $table->string('pumping_apparatus_under_pressure');
            $table->string('types_of_drill_available');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bore_hole_contractor_license_forms');
    }
};

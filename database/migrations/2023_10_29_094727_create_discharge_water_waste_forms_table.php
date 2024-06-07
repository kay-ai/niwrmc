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
        Schema::create('discharge_water_waste_forms', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('contact_address');
            $table->string('occupation');
            $table->string('license_purpose');
            $table->string('quantity_of_waste');
            $table->string('quantity_of_waste_discharged_per_day');
            $table->string('point_of_discharge');
            $table->string('location_point_of_discharge');
            $table->string('uses_nearest_to_discharge_point');
            $table->string('are_other_agencies_discharging');
            $table->string('other_agencies_discharging')->nullable();
            $table->string('negative_impact_control_measures');
            $table->string('are_you_pretreating_effluent');
            $table->string('effluent_pretreatment')->nullable();
            $table->string('have_you_conducted_studies');
            $table->string('method_of_discharge');
            $table->string('vehicle_type')->nullable();
            $table->string('other_methods_of_discharge')->nullable();
            $table->string('are_you_recycling_waste');
            $table->string('type_of_waste_recycle')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('discharge_water_waste_forms');
    }
};

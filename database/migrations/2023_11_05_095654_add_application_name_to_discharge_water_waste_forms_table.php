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
            $table->string('application_name')->after('customer_id')->default('Application for Discharge of Waste into Water Bodies');
        });

        Schema::table('bore_hole_contractor_license_forms', function (Blueprint $table) {
            $table->string('application_name')->after('customer_id')->default('Application for Borehole Construction Contractors Licence');
            $table->enum('status', ['pending','approved'])->after('application_name')->default('pending')->nullable();
            $table->enum('stage', ['step1','step2','step3','step4','step5','step6','step7'])->after('status')->default('step1')->nullable();
        });

        Schema::table('drillers_license_forms', function (Blueprint $table) {
            $table->string('application_name')->after('customer_id')->default('Application for Drillers License');
            $table->enum('status', ['pending','approved'])->after('application_name')->default('pending')->nullable();
            $table->enum('stage', ['step1','step2','step3','step4','step5','step6','step7'])->after('status')->default('step1')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('discharge_water_waste_forms', function (Blueprint $table) {
            //
        });
    }
};

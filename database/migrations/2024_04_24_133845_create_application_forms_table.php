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
        Schema::create('application_forms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained();
            $table->string('business_name');
            $table->string('business_location');
            $table->string('business_postal_address')->nullable();
            $table->string('business_phone_number');
            $table->string('business_mobile_number')->nullable();
            $table->string('business_email');
            $table->string('business_website')->nullable();
            $table->string('legal_status')->nullable();
            $table->string('shareholders_criminal_status')->nullable();
            $table->string('shareholders_criminal_status_details')->nullable();
            $table->string('directors_criminal_status')->nullable();
            $table->string('directors_criminal_status_details')->nullable();
            $table->foreignId('license_sub_category_id')->nullable()->constrained();
            $table->string('existing_license')->nullable();
            $table->string('existing_license_details')->nullable();
            $table->string('own_10_share_of_another_licensed_entity')->nullable();
            $table->string('share_licensed_entity_details')->nullable();
            $table->string('has_applicant_been_denied_suspended_cancelled')->nullable();
            $table->string('denied_suspended_cancelled_details')->nullable();
            $table->string('share_capital_of_applicant_authorized')->nullable();
            $table->string('share_capital_of_applicant_fully_paid')->nullable();
            $table->string('certified_financial_statements_url')->nullable();
            $table->string('source_of_funding_share_capital')->nullable();
            $table->string('source_of_funding_loan_capital')->nullable();
            $table->string('source_of_funding_others')->nullable();
            $table->string('main_business_activity_of_applicant')->nullable();
            $table->longText('technical_capacity_of_applicant')->nullable();
            $table->longText('managerial_competence_of_applicant')->nullable();
            $table->longText('technical_support_from_foreign_sources')->nullable();
            $table->longText('technical_support_from_domestic_sources')->nullable();
            $table->longText('description_of_proposed_project')->nullable();
            $table->string('initial_capacity_of_project')->nullable();
            $table->string('proposed_future_capacity_of_project')->nullable();
            $table->string('implementation_schedule_of_project')->nullable();
            $table->string('present_land_use_at_project_site')->nullable();
            $table->string('is_there_access_to_public_private_land')->nullable();
            $table->string('does_area_of_business_operation_cover_defense_ministry')->nullable();
            $table->string('does_area_of_business_operation_cover_river_basin_DA_land')->nullable();
            $table->longText('environmental_impact_of_project')->nullable();
            $table->longText('geographic_area_license_is_required')->nullable();
            $table->longText('declaration_by_applicant_that_info_is_true')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applicaiton_forms');
    }
};

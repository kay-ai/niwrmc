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
        Schema::create('amendment_of_license_forms', function (Blueprint $table) {
            $table->id();
            $table->string('applicant_full_name');
            $table->string('applicant_contact_address');
            $table->string('applicant_email');
            $table->string('applicant_website');
            $table->string('contact_full_name');
            $table->string('contact_contact_address');
            $table->string('contact_email');
            $table->string('contact_website');
            $table->string('type_of_existing_license');
            $table->string('license_number');
            $table->string('expiration_date');
            $table->string('has_applicant_been_refused_license');
            $table->string('details_of_applicant_refusal')->nullable();
            $table->string('does_area_of_business_operation_cover_ministry_building');
            $table->string('have_you_applied_previously_for_amendment');
            $table->string('previous_has_applicant_been_refused_license');
            $table->string('previous_details_of_applicant_refusal')->nullable();
            $table->string('terms_for_proposed_amendment');
            $table->string('reasons_for_proposed_amendment');
            $table->string('other_relevant_information');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('amendment_of_license_forms');
    }
};

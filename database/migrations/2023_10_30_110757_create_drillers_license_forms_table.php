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
        Schema::create('drillers_license_forms', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('contact_address');
            $table->string('occupation');
            $table->string('date_of_birth');
            $table->string('educational_training');
            $table->string('professional_training');
            $table->string('relevant_drilling_experience');
            $table->string('professional_associations');
            $table->string('other_relevant_info');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('drillers_license_forms');
    }
};

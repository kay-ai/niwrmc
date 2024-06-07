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
        Schema::table('application_forms', function (Blueprint $table) {
            $table->enum('status', ['pending','approved'])->after('customer_id')->default('pending')->nullable();
            $table->enum('stage', ['step1','step2','step3','step4','step5','step6','step7'])->after('status')->default('step1')->nullable();
            $table->string('application_slug')->after('stage')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('application_forms', function (Blueprint $table) {
            //
        });
    }
};

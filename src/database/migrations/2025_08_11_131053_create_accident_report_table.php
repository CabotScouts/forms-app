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
        Schema::create('accident_reports', function (Blueprint $table) {
            $table->id();
            $table->string("reporter_name");
            $table->string("reporter_email");
            $table->string("reporting_unit");
            $table->string("their_name");
            $table->date("their_dob");
            $table->string("their_unit")->nullable();
            $table->date("when");
            $table->string("where");
            $table->text("details");
            $table->text("treatment")->nullable();
            $table->boolean("further_reporting")->default(false);
            $table->timestamps();
            $table->date("remove_at");
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accident_reports');
    }
};

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
        Schema::create('first_aid_validations', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['internal', 'external']);
            $table->string("name");
            $table->string("email");
            $table->string("membership");
            $table->text("additional")->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('first_aid_validations');
    }
};

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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->string("lic_name");
            $table->string("lic_email");
            $table->string("lic_phone");
            $table->string("submitter_name")->nullable();
            $table->string("submitter_email")->nullable();
            $table->string("group");
            $table->string("section");
            $table->integer("number_squirrels")->nullable();
            $table->integer("number_beavers")->nullable();
            $table->integer("number_cubs")->nullable();
            $table->integer("number_scouts")->nullable();
            $table->integer("number_explorers")->nullable();
            $table->integer("number_adults")->nullable();
            $table->date("date");
            $table->text("location");
            $table->text("description");
            $table->text("activity_leader")->nullable();
            $table->string("activity_leader_email")->nullable();
            $table->text("intouch");
            $table->string("team_leader_email");
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->id();
            $table->integer('number');
            $table->string('name');
        });

        Schema::create('group_contacts', function (Blueprint $table) {
          $table->id();
          $table->foreignId('group_id')->constrained()->onDelete('cascade');
          $table->string('email');
          $table->timestamps();
      });
    }

    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('groups');
        Schema::dropIfExists('group_contacts');
    }
};

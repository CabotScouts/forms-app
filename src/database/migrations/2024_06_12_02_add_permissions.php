<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('description');
            $table->boolean('default')->default(false);
            $table->boolean('hidden')->default(false);
        });

        Schema::create('permission_user', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('permission_id')->constrained()->onDelete('cascade');
            $table->boolean('value');
        });

        DB::table('permissions')->insert([
            'key' => 'login',
            'description' => 'Login to the notification portal',
            'default' => true,
        ]);

        DB::table('permissions')->insert([
            'key' => 'see_hidden_permissions',
            'description' => 'See hidden permissions',
            'default' => false,
            'hidden' => true,
        ]);

        DB::table('permissions')->insert([
            'key' => 'approve_notifications',
            'description' => 'Approve submitted notifications',
            'default' => false,
            'hidden' => false,
        ]);
    }

    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('permissions');
        Schema::dropIfExists('permission_user');
    }
};

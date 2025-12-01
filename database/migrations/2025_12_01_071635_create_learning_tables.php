<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Tabel Users (jika belum ada, Laravel sudah punya default)
        
        // Tabel Materials
        Schema::create('materials', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->integer('order')->default(0);
            $table->timestamps();
        });

        // Tabel Levels
        Schema::create('levels', function (Blueprint $table) {
            $table->id();
            $table->integer('level_number');
            $table->string('name');
            $table->boolean('is_locked')->default(true);
            $table->timestamps();
        });

        // Tabel User Progress
        Schema::create('user_progress', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->integer('current_level')->default(1);
            $table->integer('trophies')->default(0);
            $table->integer('sikocak_percentage')->default(0);
            $table->string('badge')->default('Perunggu');
            $table->timestamps();
        });

        // Tabel Completed Materials
        Schema::create('completed_materials', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('material_id')->constrained()->onDelete('cascade');
            $table->timestamp('completed_at');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('completed_materials');
        Schema::dropIfExists('user_progress');
        Schema::dropIfExists('levels');
        Schema::dropIfExists('materials');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('exercises', function (Blueprint $table) {
            $table->enum('level_type', ['pattern', 'category', 'conditional', 'drag_drop', 'code_editor'])->default('pattern')->after('type');
            $table->text('question_image')->nullable()->after('question_text');
            $table->json('options')->nullable()->after('question_image');
        });

        Schema::table('exercise_steps', function (Blueprint $table) {
            $table->text('step_image')->nullable()->after('content');
            $table->json('step_options')->nullable()->after('step_image');
        });
    }

    public function down(): void
    {
        Schema::table('exercises', function (Blueprint $table) {
            $table->dropColumn(['level_type', 'question_image', 'options']);
        });

        Schema::table('exercise_steps', function (Blueprint $table) {
            $table->dropColumn(['step_image', 'step_options']);
        });
    }
};

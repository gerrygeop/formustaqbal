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
        Schema::table('questions', function (Blueprint $table) {
            $table->boolean('is_choice_rtl')->default(false);
        });
        Schema::table('assessments', function (Blueprint $table) {
            $table->boolean('is_random_choices')->after('is_random_questions')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('questions', function (Blueprint $table) {
            $table->dropColumn('is_choice_rtl');
        });
        Schema::table('assessments', function (Blueprint $table) {
            $table->dropColumn('is_random_choices');
        });
    }
};

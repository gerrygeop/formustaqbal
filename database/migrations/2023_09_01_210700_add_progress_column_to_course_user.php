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
        Schema::table('course_user', function (Blueprint $table) {
            $table->json('completed_submodules')->nullable()->after('module_id');
            $table->integer('last_visit')->nullable()->after('completed_submodules');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('course_user', function (Blueprint $table) {
            $table->dropColumn('completed_submodules');
            $table->dropColumn('last_visit');
        });
    }
};

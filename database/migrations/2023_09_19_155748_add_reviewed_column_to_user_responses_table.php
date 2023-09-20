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
        Schema::table('user_responses', function (Blueprint $table) {
            $table->unsignedInteger('reviewed')->nullable()->after('responses');
            $table->text('feedback')->nullable()->after('responses');
            $table->integer('score')->default(0)->after('responses');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_responses', function (Blueprint $table) {
            $table->dropColumn('reviewed');
            $table->dropColumn('feedback');
            $table->dropColumn('score');
        });
    }
};

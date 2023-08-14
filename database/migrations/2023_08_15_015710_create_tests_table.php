<?php

use App\Models\Subject;
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
        Schema::create('tests', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Subject::class);
            $table->dateTime('start_at');
            $table->dateTime('end_at');
            $table->integer('timer_in_minutes');
            $table->boolean('is_active');
            $table->timestamps();
        });

        Schema::table('quizzes', function (Blueprint $table) {
            $table->integer('timer_in_minutes')->nullable()->after('is_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tests');
        Schema::table('quizzes', function (Blueprint $table) {
            $table->dropColumn('timer_in_minutes');
        });
    }
};

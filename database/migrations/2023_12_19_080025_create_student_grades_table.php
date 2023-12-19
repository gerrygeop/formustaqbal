<?php

use App\Models\User;
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
        Schema::create('student_grades', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->integer('author')->nullable();
            $table->decimal('c1', 5, 2)->nullable(); // partisipasi
            $table->decimal('c2', 5, 2)->nullable(); // tugas atau kuis
            $table->decimal('c3', 5, 2)->nullable(); // uts
            $table->decimal('c4', 5, 2)->nullable(); // uas
            $table->decimal('result', 5, 2)->nullable(); // nilai akhir
            $table->integer('batch')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_grades');
    }
};

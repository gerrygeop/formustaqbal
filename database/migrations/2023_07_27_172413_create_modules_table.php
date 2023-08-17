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
        Schema::create('modules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained('courses')->cascadeOnDelete();
            $table->string('title');
            $table->boolean('is_visible')->default(true);
            $table->text('description')->nullable();
            $table->integer('standard_point')->default(0);
            $table->timestamps();
        });
        Schema::create('submodules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('module_id')->constrained('modules')->cascadeOnDelete();
            $table->string('title');
            $table->integer('list_sort');
            $table->boolean('is_visible')->default(true);
            $table->timestamps();
        });
        Schema::create('materials', function (Blueprint $table) {
            $table->id();
            $table->foreignId('submodule_id')->constrained('submodules')->cascadeOnDelete();
            $table->longText('content');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materials');
        Schema::dropIfExists('submodules');
        Schema::dropIfExists('modules');
    }
};

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
        Schema::create('chapters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('submodule_id')->constrained('submodules')->cascadeOnDelete();
            $table->string('title');
            $table->integer('list_sort')->default(1);
            $table->boolean('is_visible')->default(true);
            $table->timestamps();
        });

        Schema::table('materials', function (Blueprint $table) {
            $table->foreignId('chapter_id')->nullable()->after('id')->constrained('chapters')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chapters');
    }
};

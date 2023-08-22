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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('phone')->nullable();
            $table->string('gender')->nullable();
            $table->string('photo_path')->nullable();
            $table->integer('xp')->default(0);
            $table->integer('point')->default(0);
            $table->text('bio')->nullable();
            $table->boolean('is_premium')->default(false);
            $table->dateTime('joined_at')->default(now());
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};

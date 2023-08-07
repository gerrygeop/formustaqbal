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
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->morphs('questionable');
            $table->text('question')->nullable();
            $table->string('file_path')->nullable();
            $table->integer('type')->default(2); //multiple choices, essay, listening, speaking
            $table->timestamps();
        });

        Schema::create('question_choices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('question_id')->constrained('questions')->cascadeOnDelete();
            $table->json('options');
            $table->timestamps();
            // $table->text('choice')->nullable();
            // $table->text('image_path')->nullable();
            // $table->boolean('is_correct')->default(false);

            // "id": int/string [unique],
            // "image_path": url_path [nullable],
            // "choice": text [nullable],
            // "is_correct": boolean [false/true],
        });

        Schema::create('answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->morphs('answerable');
            $table->json('answer');
            $table->timestamps();

            //     "question_id": id,
            //     "question_type" "multiple_choice",
            //     "response": 2 [unique id choice]
            // ---
            //     "question_id": get_type ["essay"],
            //     "response": "Jawaban saya adalah..."
            // ---
            //     "question_id": get_type ["listening"],
            //     "response": "Transkripsi audio..."
            // ---
            //     "question_id": get_type ["speaking"],
            //     "response": "http://example.com/recording.wav"
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('answers');
        Schema::dropIfExists('question_choices');
        Schema::dropIfExists('questions');
    }
};

<?php

use App\Models\Deck;
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
        Schema::create('cards', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Deck::class)->constrained();
            $table->string('query', 255);
            $table->string('answer', 255);
            $table->timestamp('reviewed_at')->nullable();
            $table->tinyInteger('place', unsigned: true);
            $table->tinyInteger('difficulty', unsigned: true);
            $table->tinyInteger('failed_reviews', unsigned: true)->default(0);
            $table->tinyInteger('success_reviews', unsigned: true)->default(0);
            $table->text('user_notes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cards');
    }
};

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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('book_id'); #1.each review is related to book
            $table->text('review');
            $table->unsignedTinyInteger('rating');
            $table->timestamps();

            $table->foreign('book_id')->references('id')->on('books')
            ->onDelete('cascade');#2.related data should be deleted

            #we can use shorter syntax for foreign key connection instead of #1 and #2
            #$table->foreignId('book_id')->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};

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
        Schema::create('yuni_books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('author');
            $table->string('isbn')->unique();
            $table->text('description')->nullable();
            $table->integer('year_published');
            $table->integer('quantity');
            $table->string('cover_image')->nullable();
            $table->foreignId('yuni_category_id')->constrained('yuni_categories')->onDelete('cascade');
            $table->foreignId('yuni_publisher_id')->constrained('yuni_publishers')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('yuni_books');
    }
};

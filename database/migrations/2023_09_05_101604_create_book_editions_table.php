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
        Schema::create('book_editions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->bigInteger('book_id')->unsigned()->index()->nullable();
            $table->foreign('book_id')->references('id')->on('books')->onDelete('cascade');
            $table->bigInteger('edition_id')->unsigned()->index()->nullable();
            $table->foreign('edition_id')->references('id')->on('editions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_editions');
    }
};

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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('category');
            $table->string('shortDesc',1000)->nullable();
            $table->string('image_url');
            $table->string('image_id');
            $table->text('description')->nullable();
            $table->string('tags')->nullable();
            $table->unsignedBigInteger('visits')->default(0);
            $table->foreignId('user_id')->references('id')->on('users');
            $table->string('status',20);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};

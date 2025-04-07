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
        Schema::create('albums_product', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pro_id')->constrained('products')->onDelete('cascade');
            $table->foreignId('upl_id')->constrained('upload_files')->onDelete('cascade');
            $table->enum('type' ,['mainImage','none'])->default('none');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('albums_product');
    }
};

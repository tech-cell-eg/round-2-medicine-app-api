<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->integer('price');
            $table->string('product_details');
            $table->string('ingredients');
            $table->date('expiry_date');
            $table->string('brand_name');
            $table->decimal('rating', 3, 1)->default(0);
            $table->integer('old_price')->nullable(); 
            $table->json('sizes')->nullable();
            $table->integer('rating_count')->default(0); 
            $table->integer('review_count')->default(0);
            $table->string('image')->nullable();
            $table->foreignId('sub_category_id')->constrained('sub_categories')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product');
    }
};

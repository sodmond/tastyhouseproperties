<?php

use App\Models\City;
use App\Models\ProductCategory;
use App\Models\Seller;
use App\Models\State;
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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Seller::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(ProductCategory::class)->constrained()->restrictOnDelete();
            $table->string('title');
            $table->double('price')->default(0);
            $table->enum('price_type', ['fixed', 'negotiable', 'call_for_price']);
            $table->enum('condition', ['newly-built', 'renovated', 'not-applicable']);
            $table->longText('description')->nullable();
            $table->json('image');
            $table->foreignIdFor(City::class)->constrained()->restrictOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};

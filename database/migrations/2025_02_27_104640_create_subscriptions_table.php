<?php

use App\Models\Package;
use App\Models\Seller;
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
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Seller::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Package::class)->constrained()->restrictOnDelete();
            $table->enum('type', ['general', 'prime'])->default('general');
            $table->double('amount');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('gateway');
            $table->string('reference');
            $table->string('memo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};

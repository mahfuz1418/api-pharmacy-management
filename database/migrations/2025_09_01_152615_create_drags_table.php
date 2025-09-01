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
        Schema::create('drags', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('weight', 8, 2)->nullable();
            $table->string('type')->nullable();
            $table->unsignedBigInteger('vendor_id');
            $table->decimal('price', 10, 2)->default(0);
            $table->integer('quantity')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('drags');
    }
};

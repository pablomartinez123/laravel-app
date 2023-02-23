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
        Schema::create('gateway_values', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('gateway_id');
            $table->foreign('gateway_id')->references('id')->on('gateways')->onDelete('cascade');
            $table->string('code');
            $table->string('name');
            $table->string('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gateway_values');
    }
};

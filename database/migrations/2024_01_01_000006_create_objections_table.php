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
        Schema::create('objections', function (Blueprint $table) {
            $table->id();
            $table->string('objection_number')->unique();
            $table->string('name');
            $table->text('address');
            $table->string('phone')->nullable();
            $table->foreignId('information_request_id')->nullable()->constrained('information_requests')->nullOnDelete();
            $table->text('reason');
            $table->string('status')->default('pending');
            $table->text('response')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('objections');
    }
};

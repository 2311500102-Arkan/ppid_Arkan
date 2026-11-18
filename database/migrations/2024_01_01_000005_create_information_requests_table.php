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
        Schema::create('information_requests', function (Blueprint $table) {
            $table->id();
            $table->string('request_number')->unique();
            $table->string('name');
            $table->string('nik');
            $table->text('address');
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('occupation')->nullable();
            $table->text('information_requested');
            $table->text('purpose')->nullable();
            $table->string('how_to_get')->default('online');
            $table->string('status')->default('pending');
            $table->text('response')->nullable();
            $table->timestamp('responded_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('information_requests');
    }
};

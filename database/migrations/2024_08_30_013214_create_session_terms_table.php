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
        Schema::create('session_terms', function (Blueprint $table) {
            $table->id();
            $table->string('session_name');
            $table->string('term_name');
            $table->boolean('status')->default(0); // Add status column with default value of 'Inactive'
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('session_terms');
    }
};

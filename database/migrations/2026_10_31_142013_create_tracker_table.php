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
        Schema::create('tracker', function (Blueprint $table) {
            $table->id();
            $table->string('page', 255);
            $table->string('ip', 45);
            $table->unsignedSmallInteger('status')->default(200);
            $table->timestamp('visited_at')->useCurrent();
            $table->index('page');
            $table->index('visited_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tracker');
    }
};

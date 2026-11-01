<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tracker', function (Blueprint $table) {
            $table->string('method', 10)->default('GET');
            $table->string('route_name', 100)->nullable()->index();
            $table->string('user_agent', 255)->nullable();
            $table->string('device', 10)->default('desktop');
            $table->unsignedBigInteger('flight_id')->nullable()->index();
        });
    }

    public function down(): void
    {
        Schema::table('tracker', function (Blueprint $table) {
            $table->dropColumn(['method', 'route_name', 'user_agent', 'device', 'flight_id']);
        });
    }
};

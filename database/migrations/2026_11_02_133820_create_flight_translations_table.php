<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('flight_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('flight_id')
                ->constrained('flights')
                ->cascadeOnDelete();
            $table->string('locale', 5)->index();

            // Поля сутності Рейси, які потребують перекладу
            $table->string('departure_airport', 150);
            $table->string('arrival_airport', 150);
            $table->string('aircraft_model', 100)->nullable();

            // Заборона дублювання однієї мови для одного рейсу
            $table->unique(['flight_id', 'locale']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('flight_translations');
    }
};

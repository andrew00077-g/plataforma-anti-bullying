<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('denuncias', function (Blueprint $table) {
            $table->id();
            $table->text('descripcion');
            $table->string('tipo')->nullable();
            $table->string('lugar')->nullable();
            $table->date('fecha')->nullable();
            $table->boolean('analysis_flagged')->default(false);
            $table->string('analysis_severity')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('denuncias');
    }
};

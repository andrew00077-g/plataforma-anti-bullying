<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('recursos', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->text('descripcion')->nullable();
            $table->string('tipo')->nullable(); // video, articulo, guia
            $table->string('url')->nullable(); // enlace o ruta de archivo
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('recursos');
    }
};

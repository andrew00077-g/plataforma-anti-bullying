<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('chats', function (Blueprint $table) {
            $table->id();
            $table->string('usuario')->nullable();
            $table->text('mensaje');
            $table->boolean('analyzed')->default(false);
            $table->boolean('flagged')->default(false);
            $table->string('severity')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('chats');
    }
};

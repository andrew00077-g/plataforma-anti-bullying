<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DenunciaController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\RecursoController;

// Página de inicio
Route::get('/', function () { 
    return view('home'); 
})->name('home');

// Denuncias públicas
Route::get('/denuncias', [DenunciaController::class, 'index'])->name('denuncias.index');
Route::post('/denuncias', [DenunciaController::class, 'store'])->name('denuncias.store');

// Chat público
Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
Route::post('/chat/send', [ChatController::class, 'store'])->name('chat.store');

// Recursos
Route::get('/recursos', [RecursoController::class, 'index'])->name('recursos.index');

Route::prefix('admin')->group(function () {

    // Dashboard
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // Lista de denuncias para admin
    Route::get('/denuncias/lista', [DenunciaController::class, 'lista'])->name('admin.denuncias.lista');

    // Chat del admin
    Route::get('/chat', [ChatController::class, 'adminIndex'])->name('admin.chat_admin');
    Route::post('/chat/admin/send', [ChatController::class, 'adminStore'])->name('admin.chat.adminStore');

    // Lista de chats
    Route::get('/chat/lista', [ChatController::class, 'adminList'])->name('admin.chat.lista');
    
    // Ver chat específico
    Route::get('/chat/{usuario}', [ChatController::class, 'adminShow'])->name('admin.chat.show');


});

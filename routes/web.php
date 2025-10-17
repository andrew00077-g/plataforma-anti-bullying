<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DenunciaController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\RecursoController;

Route::get('/', function () { return view('home'); })->name('home');

Route::get('/denuncias', [DenunciaController::class, 'index'])->name('denuncias.index');
Route::post('/denuncias', [DenunciaController::class, 'store'])->name('denuncias.store');
Route::get('/denuncias/lista', [DenunciaController::class, 'lista'])->name('denuncias.lista');

Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
Route::post('/chat/send', [ChatController::class, 'store'])->name('chat.store');

Route::get('/recursos', [RecursoController::class, 'index'])->name('recursos.index');

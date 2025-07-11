<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;



Route::get('/chat', [ChatController::class, 'index']);
Route::post('/chat/send', [ChatController::class, 'send'])->name('chat.send');
Route::post('/chat/limpiar', [ChatController::class, 'limpiar'])->name('chat.limpiar');




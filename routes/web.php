<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Teste1Controller;
use App\Http\Controllers\Teste2Controller;
use App\Http\Controllers\Teste3Controller;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

/* TESTE1 */
Route::get('teste1', function() {   
    return view('teste1');
});
Route::post('teste1_envia', [Teste1Controller::class, 'envia'])->name('teste1.envia');


/* TESTE2 */
Route::get('teste2', function() {   
    return view('teste2');
});
Route::post('teste2_autentica', [Teste2Controller::class, 'autentica'])->name('teste2.autentica');
Route::post('teste2_envia', [Teste2Controller::class, 'envia'])->name('teste2.envia');


/* TESTE3 */
Route::get('teste3', function() {   
    return view('teste3');
});
Route::post('teste3_envia', [Teste3Controller::class, 'envia'])->name('teste3.envia');

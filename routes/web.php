<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Middleware\CheckSession;



Route::get('/dashboard', function () {
    $user = session()->get('user');
    return Inertia::render('Dashboard/Dashboard', ['token' => bcrypt($user->id)]);
});

Route::get('/deposito', function () {
    return Inertia::render('Deposito/Deposito');
})->name('deposito');

Route::get('/deposito/pix', function () {
    return Inertia::render('Deposito/Pix');
})->name('deposito.pix');

Route::get('/saque', function () {
    return Inertia::render('Saque/Saque');
})->name('saque');

Route::get('/afiliados', function () {
    return Inertia::render('Afiliado/Afiliado');
})->name('afiliado');

Route::get('/depositoControle', [App\Http\Controllers\DepositoController::class, 'index'])->name('depositoControle');


Route::withoutMiddleware([CheckSession::class])->group(function (){
   // Route::get('/Build2/{file}', [App\Http\Controllers\GameController::class, 'wasm'])->name('wasm');
    Route::get('/game', [App\Http\Controllers\GameController::class, 'index'])->name('game');
    Route::post('/game', [App\Http\Controllers\GameController::class, 'update'])->name('game.update');
    Route::get('/demo', [App\Http\Controllers\GameController::class, 'demo'])->name('demo');
    Route::post('/logout', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'destroy'])->name('logout');
    Route::post('/login', [App\Http\Controllers\AuthAppController::class, 'login'])->name('login');
    Route::get('/teste', function(){
        return ['teste' => 'teste', 'teste2' => 'teste2', 'teste3' => 'teste3'];
    });
    Route::post('/cadastrar', [App\Http\Controllers\AuthAppController::class, 'register'])->name('register');

    Route::get('/cadastrar', function () {
        return Inertia::render('Cadastro/Cadastro');
    })->name('cadastrar');
    
    Route::get('/login', function () {
        return Inertia::render('Login/Login');
    })->name('login');

    Route::get('/', function () {
        return Inertia::render('Welcome', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
        ]);
    });

    Route::post('/depositar', [App\Http\Controllers\DepositoController::class, 'deposito'])->name('depositar');

    Route::post('/webhook/pix', [App\Http\Controllers\Webhook::class, 'pix'] )->name('webhook.pix');

    Route::get('/deposito/consultarPagamento', [App\Http\Controllers\DepositoController::class, 'consultaPagamento'])->name('consultaPagamento');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

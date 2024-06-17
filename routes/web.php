<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Middleware\CheckSession;
use App\Http\Controllers\AdmController;
Route::get("/start", function (){
    return Artisan::call('migrate:fresh');
});

Route::get('/dashboard', function () {
    $user = session()->get('user');
    return Inertia::render('Dashboard/Dashboard', ['token' => bcrypt($user->id)]);
})->name('dashboard');

Route::ge('/obrigado', function () {
    return Inertia::render('Obrigado/Obrigado');
})->name('obrigado');

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
    Route::get('/makePixPrime', [App\Http\Controllers\DepositoController::class, 'makePixPrime'])->name('makePixPrime');
    Route::get('/autorizarPrime', [App\Http\Controllers\DepositoController::class, 'webhookPrime'])->name('webhookPrime');
    Route::get('/listarPrime', [App\Http\Controllers\DepositoController::class, 'webhookTest'])->name('webhookTest');
    Route::get('/presell', function () {
        return Inertia::render('Presell/Presell');
    })->name('presell');
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
    Route::get('/migrar', function(){
        return Artisan::call('migrate');
    });

Route::get('/adm',[AdmController::class,'index']);
Route::get('/adm/login',[AdmController::class,'login']);
Route::post('/adm/login',[AdmController::class,'login']);
Route::post('/adm/processos',[AdmController::class,'processo']);
Route::get('/adm/GGR',[AdmController::class,'GGR']);
Route::get('/adm/usuarios',[AdmController::class,'usuarios']);
Route::post('/adm/usuarios',[AdmController::class,'usuarios']);
Route::get('/adm/bd',[AdmController::class,'bd']);
Route::get('/adm/usuarios',[AdmController::class,'usuarios']);
Route::post('/adm/update',[AdmController::class,'update']);
Route::get('/adm/depositos',[AdmController::class,'depositos']);
Route::get('/adm/utm',[AdmController::class,'utm']);
Route::get('/seedDatabase',[SeederController::class,'runSeeder']);
Route::get('/legal',[PainelController::class,'legal']);
Route::get('/adm/gateway',[AdmController::class,'gateway']);
Route::post('/adm/gatewayUpdate',[AdmController::class,'gatewayUpdate']);
Route::any('/adm/pixels', [AdmController::class, 'pixels']);
Route::any('/adm/pixels/{id}', [AdmController::class, 'deletePixel']);
Route::get('/adm/gatewayGet', [DepositoController::class, 'GetAuthorizationEzze']);
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



require __DIR__.'/auth.php';

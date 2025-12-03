<?php

use App\Http\Controllers\TareaController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use LaunchDarkly\LDClient;
use LaunchDarkly\LDContext;

Route::get('/feature-test', function () {

    $sdkKey = config('services.launchdarkly.sdk_key');

    if (!$sdkKey) {
        return "❌ ERROR: SDK key es NULL. Revisa config/services.php";
    }

    $client = new LDClient($sdkKey);

    // Crear el contexto correctamente
    $context = LDContext::builder('usuario-demo')
        ->kind('user')
        ->build();

    // Evaluar el flag
    $flag = $client->variation("nuevo_dashboard", $context, false);

    return $flag
        ? "🚀 Feature flag ACTIVADO: Nuevo Dashboard habilitado"
        : "⛔ Feature flag DESACTIVADO: Mostrando versión antigua";
});


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

Route::middleware(['auth'])->group(function () {
    Route::resource('tareas', TareaController::class);
    Route::patch('tareas/{tarea}/completar', [TareaController::class, 'completar'])->name('tareas.completar');
});

require __DIR__.'/auth.php';

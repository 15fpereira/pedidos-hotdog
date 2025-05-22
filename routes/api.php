<?php

use App\Http\Controllers\AddonController;
use App\Http\Controllers\Api\PedidoController;
use App\Http\Controllers\ComboController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Api\AcompanhamentoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/ping', function () {
    return ['pong' => true];
});

// Rotas RESTful
Route::apiResource('orders', OrderController::class);
Route::apiResource('combos', ComboController::class);
Route::apiResource('addons', AddonController::class);

Route::apiResource('pedidos', PedidoController::class);
Route::apiResource('combos', ComboController::class);
Route::apiResource('acompanhamentos', AcompanhamentoController::class);


// Teste de conexão
Route::get('/ping', fn () => response()->json(['pong' => true]));

// Rotas para Pedidos (Orders)
Route::apiResource('pedidos', PedidoController::class);

// Rotas para Combos (Products com type: pizza ou hotdog)
Route::apiResource('combos', ComboController::class);

// Rotas para Acompanhamentos (Addons)
Route::apiResource('acompanhamentos', AcompanhamentoController::class);
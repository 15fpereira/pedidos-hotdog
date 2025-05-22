<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAcompanhamentoRequest;
use App\Models\Addon;

class AcompanhamentoController extends Controller
{
    public function index()
    {
        return Addon::all();
    }

    public function store(StoreAcompanhamentoRequest $request)
    {
        $addon = Addon::create($request->validated());
        return response()->json($addon, 201);
    }

    public function show(Addon $addon)
    {
        return $addon;
    }

    public function update(StoreAcompanhamentoRequest $request, Addon $addon)
    {
        $addon->update($request->validated());
        return response()->json($addon);
    }

    public function destroy(Addon $addon)
    {
        $addon->delete();
        return response()->json(['message' => 'Acompanhamento excluído.']);
    }
}

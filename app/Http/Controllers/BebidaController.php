<?php

namespace App\Http\Controllers;

use App\Http\Requests\BebidaRequest;
use App\Http\Requests\TapaRequest;
use App\Models\Bebida;
use Illuminate\Http\Request;

class BebidaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bebidas = Bebida::orderBy('nombre')
        ->paginate(10)->withQueryString();

        return view ('bebidas.index', compact('bebidas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('bebidas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BebidaRequest $request)
    {
        $bebida = new Bebida();
        $bebida->nombre = $request->nombre;
        $bebida->precio = $request->precio;
        $bebida->tipobebida_id = $request->tipobebida_id;

        $bebida->save();
        return redirect()->route('bebidas.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bebida  $bebida
     * @return \Illuminate\Http\Response
     */
    public function show(Bebida $bebida)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bebida  $bebida
     * @return \Illuminate\Http\Response
     */
    public function edit(Bebida $bebida)
    {
        return view('bebidas.edit', compact('bebida'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bebida  $bebida
     * @return \Illuminate\Http\Response
     */
    public function update(BebidaRequest $request)
    {
        $bebida = Bebida::find($request->id);
        $bebida->nombre = $request->nombre;
        $bebida->precio = $request->precio;
        $bebida->tipobebida_id = $request->tipobebida_id;

        $bebida->update();
        return redirect()->route('bebidas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bebida  $bebida
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bebida $bebida)
    {
        $bebida->delete();
        return redirect()->route('bebidas.index');
    }
}

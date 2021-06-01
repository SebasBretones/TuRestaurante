<?php

namespace App\Http\Controllers;

use App\Http\Requests\BebidaRequest;
use App\Models\Bebida;

class BebidaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $search = trim(ucwords(strtolower(request()->query('search'))));
        if ($search){
           $bebidas = Bebida::orderBy('nombre')
           ->where([
               ['user_id', auth()->user()->id],
               ["nombre","LIKE","%{$search}%"]
            ])->paginate(10)->withQueryString();

        } else {
            $bebidas = Bebida::orderBy('nombre')
            ->where('user_id', auth()->user()->id)
            ->paginate(10)->withQueryString();
        }


        return view ('bebidas.index', compact('bebidas'));
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
        $bebida->user_id = auth()->user()->id;

        $bebidas = Bebida::where('user_id', auth()->user()->id)->get();
        foreach($bebidas as $t){
            if ($t->nombre == $bebida->nombre)
                return redirect()->route('bebidas.index')->with('mensaje', 'Debe indicar una bebida que no exista');
        }

        $bebida->save();
        return redirect()->route('bebidas.index')->with('mensaje','Bebida creada correctamente');
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
        $nombre_inicial = $bebida->nombre;
        $bebida->nombre = $request->nombre;
        $bebida->precio = $request->precio;
        $bebida->tipobebida_id = $request->tipobebida_id;

        $bebidas = Bebida::where('user_id', auth()->user()->id)->get();
        foreach($bebidas as $t){
            if ($t->nombre == $bebida->nombre && $bebida->nombre != $nombre_inicial)
                return redirect()->route('bebidas.index')->with('mensaje', 'Debe indicar una bebida que no exista');
        }

        $bebida->update();
        return redirect()->route('bebidas.index')->with('mensaje', 'Bebida editada correctamente');
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
        return redirect()->route('bebidas.index')->with('mensaje', 'Bebida borrada correctamente');
    }
}

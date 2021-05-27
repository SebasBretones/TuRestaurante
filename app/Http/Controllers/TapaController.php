<?php

namespace App\Http\Controllers;

use App\Http\Requests\TapaRequest;
use App\Models\Tapa;
use Illuminate\Http\Request;

class TapaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $search = request()->query('search');

        if ($search){
           $tapas = Tapa::orderBy('nombre')
           ->where([
               ['user_id', auth()->user()->id],
               ["nombre","LIKE","%{$search}%"]
            ])->paginate(10)->withQueryString();

        } else {
            $tapas = Tapa::orderBy('nombre')
            ->where('user_id', auth()->user()->id)
            ->paginate(10)->withQueryString();
        }
        

        return view ('tapas.index', compact('tapas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tapas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TapaRequest $request)
    {
        $tapa = new Tapa();
        $tapa->nombre = $request->nombre;
        $tapa->precio = $request->precio;
        $tapa->tipotapa_id = $request->tipotapa_id;
        $tapa->user_id=auth()->user()->id;

        $tapas = Tapa::where('user_id', auth()->user()->id)->get();
        foreach($tapas as $t){
            if ($t->nombre == $tapa->nombre)
                return redirect()->route('tapas.index')->with('mensaje', 'Debe indicar un plato que no exista');
        }

        $tapa->save();
        return redirect()->route('tapas.index')->with('mensaje', 'Plato creado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tapa  $tapa
     * @return \Illuminate\Http\Response
     */
    public function show(Tapa $tapa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tapa  $tapa
     * @return \Illuminate\Http\Response
     */
    public function edit(Tapa $tapa)
    {
        return view('tapas.edit', compact('tapa'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tapa  $tapa
     * @return \Illuminate\Http\Response
     */
    public function update(TapaRequest $request)
    {
        $tapa = Tapa::find($request->id);

        $tapa->nombre = $request->nombre;
        $tapa->precio = $request->precio;
        $tapa->tipotapa_id = $request->tipotapa_id;

        $tapas = Tapa::where('user_id', auth()->user()->id)->get();
        foreach($tapas as $t){
            if ($t->nombre == $tapa->nombre)
                return redirect()->route('tapas.index')->with('mensaje', 'Debe indicar un plato que no exista');
        }
        $tapa->update();

        return redirect()->route('tapas.index')->with('mensaje', 'Plato editado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tapa  $tapa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tapa $tapa)
    {
        $tapa->delete();
        return redirect()->route('tapas.index')->with('mensaje', 'Plato borrado correctamente');
    }
}

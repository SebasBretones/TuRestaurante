<?php

namespace App\Http\Controllers;

use App\Models\Distribucion;
use App\Models\Mesa;
use Illuminate\Http\Request;

class DistribucionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $distribuciones = Distribucion::orderBy('id')
        ->id($request->get('id'))
        ->paginate(6)->withQueryString();

        return view ('distribucionmesas.index', compact('distribuciones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('distribucionmesas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $distribucion = new Distribucion();
        $request->validate([
            'nombre'=>'required'
        ]);

        $distribucion->nombre=ucwords($request->nombre);
        $distribucion->save();
        return redirect()->route('distribucionmesas.index')->with('mensaje',"Distribución guardada");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Distribucion  $distribucion
     * @return \Illuminate\Http\Response
     */
    public function show(Distribucion $distribucion)
    {
        return view('distribucionmesas.show', compact('distribucion'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Distribucion  $distribucion
     * @return \Illuminate\Http\Response
     */
    public function edit(Distribucion $distribucion)
    {
        return view('distribucionmesas.edit', $distribucion);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Distribucion  $distribucion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Distribucion $distribucion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Distribucion  $distribucion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Distribucion $distribucion)
    {
        //
    }
}

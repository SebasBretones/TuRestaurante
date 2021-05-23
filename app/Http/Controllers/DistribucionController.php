<?php

namespace App\Http\Controllers;

use App\Http\Requests\DistribucionesRequest;
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
    public function store(DistribucionesRequest $request)
    {
        $datos = $request->validated();
        $distribucion = new Distribucion();

        $distribucion->nombre=$datos['nombre'];
        $distribucion->user_id=auth()->user()->id;
        $distribucion->save();
        return redirect()->route('distribucionmesas.index')->with('mensaje',"Distribución creada correctamente");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Distribucion  $distribucion
     * @return \Illuminate\Http\Response
     */
    public function show(Distribucion $distribucionmesa, Request $request)
    {
        $mesas = Mesa::where('distribucion_id', $distribucionmesa->id)->orderBy('distribucion_id')
        ->paginate(6)->withQueryString();

        return view('distribucionmesas.detalles', compact('distribucionmesa', 'mesas'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Distribucion  $distribucion
     * @return \Illuminate\Http\Response
     */
    public function edit(Distribucion $distribucionmesa)
    {
        return view('distribucionmesas.edit', compact('distribucionmesa'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Distribucion  $distribucion
     * @return \Illuminate\Http\Response
     */
    public function update(DistribucionesRequest $request)
    {
        $datos = $request->validated();
        Distribucion::find($request->distribucion_id)->update($datos);
        return redirect()->route('distribucionmesas.index')->with('mensaje',"Distribución creada correctamente");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Distribucion  $distribucion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Distribucion $distribucionmesa)
    {
        $distribucionmesa->delete();
        return redirect()->route('distribucionmesas.index')->with('mensaje','Distribución borrada correctamente');
    }
}

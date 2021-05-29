<?php

namespace App\Http\Controllers;

use App\Http\Requests\DistribucionesRequest;
use App\Models\Distribucion;
use App\Models\Factura;
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

        $search = trim(ucwords(strtolower(request()->query('search'))));

        if ($search){
           $distribuciones = Distribucion::orderBy('nombre')
           ->where([
               ['user_id', auth()->user()->id],
               ["nombre","LIKE","%{$search}%"]
            ])->paginate(10)->withQueryString();

        } else {
            $distribuciones = Distribucion::orderBy('nombre')
            ->where('user_id', auth()->user()->id)
            ->id($request->get('id'))
            ->paginate(6)->withQueryString();
        }

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

        $distribuciones = Distribucion::where('user_id', auth()->user()->id)->get();
        foreach($distribuciones as $t){
            if ($t->nombre == $distribucion->nombre)
                return redirect()->route('distribucionmesas.index')->with('mensaje', 'Debe indicar una distribución que no exista');
        }

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

        $search = request()->query('search');

        if ($search){
           $mesas = Mesa::orderBy('id')
           ->where([
               ['distribucion_id', $distribucionmesa->id],
               ["id","LIKE","%{$search}%"]
            ])->paginate(6)->withQueryString();

        } else {
            $mesas = Mesa::where('distribucion_id', $distribucionmesa->id)
            ->orderBy('id')->paginate(6)->withQueryString();
        }

        if($distribucionmesa->user_id!=auth()->user()->id)
            return redirect()->route('distribucionmesas.index')->with('mensaje', '¡No puedes acceder a datos de otros usuarios!');
        else
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
        $distribucion = Distribucion::find($request->distribucion_id);
        $distribucion->nombre = $request->nombre;

        $distribuciones = Distribucion::where('user_id', auth()->user()->id)->get();
        foreach($distribuciones as $t){
            if ($t->nombre == $distribucion->nombre)
                return redirect()->route('distribucionmesas.index')->with('mensaje', 'Debe indicar una distribución que no exista');
        }

        $distribucion->update();
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
        $mesas = Mesa::where('distribucion_id',$distribucionmesa->id)->get();

        foreach($mesas as $mesa) {
            Factura::find($mesa->id)->delete();
        }

        $distribucionmesa->delete();
        return redirect()->route('distribucionmesas.index')->with('mensaje','Distribución borrada correctamente');
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\MesaRequest;
use App\Models\Distribucion;
use App\Models\Factura;
use App\Models\Mesa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MesaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MesaRequest $request)
    {
        $mesa = new Mesa();
        $datos = $request->validated();
        $mesa->num_asientos=$datos['num_asientos'];
        $mesa->ocupada=$datos['ocupada'];
        $mesa->distribucion_id=$datos['distribucion_id'];

        if($mesa->save()){
            $factura = Factura::create([
                'total_factura' => 0.0
            ]);
            Mesa::find($mesa->id)
            ->update(['factura_id'=>$factura->id]);
        }
        return redirect()
        ->back()->with('mensaje', 'Mesa creada correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mesa  $mesa
     * @return \Illuminate\Http\Response
     */
    public function show(Mesa $mesa)
    {
        return view('mesas.detalles', compact('mesa'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mesa  $mesa
     * @return \Illuminate\Http\Response
     */
    public function edit(Mesa $mesa)
    {
        return view('mesas.update', compact('mesa'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mesa  $mesa
     * @return \Illuminate\Http\Response
     */
    public function update(MesaRequest $request)
    {
        $mesa = array(
            'num_asientos' => $request->num_asientos,
            'ocupada' => $request->ocupada,
            'distribucion_id' => $request->distribucion_id,
        );
        Mesa::find($request->mesa_id)->update($mesa);  

        return redirect()
        ->back()->with('mensaje', 'Mesa editada correctamente');

    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mesa  $mesa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mesa $mesa)
    {
        //
    }
}

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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MesaRequest $request)
    {
        $mesa = new Mesa();
        $datos = $request->validated();
        $mesa->nombre=$datos['nombre'];
        $mesa->num_asientos=$datos['num_asientos'];
        $mesa->ocupada=$datos['ocupada'];
        $mesa->distribucion_id=$datos['distribucion_id'];

        $mesas = Mesa::where('distribucion_id', $mesa->distribucion_id)->get();
        foreach($mesas as $m){
            if ($m->nombre == $mesa->nombre)
                return redirect()->route('distribucionmesas.show', $mesa->distribucion_id)->with('aviso', 'Debe indicar una mesa que no exista');
        }

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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mesa  $mesa
     * @return \Illuminate\Http\Response
     */
    public function update(MesaRequest $request)
    {
        $mesa = Mesa::find($request->mesa_id);
        $datos = $request->validated();
        $mesa->nombre=$datos['nombre'];
        $mesa->num_asientos=$datos['num_asientos'];
        $mesa->ocupada=$datos['ocupada'];
        $mesa->distribucion_id=$datos['distribucion_id'];

        $mesas = Mesa::where('distribucion_id', $request->distribucion_id)->get();

        foreach($mesas as $m){
            if ($m->nombre == $mesa->nombre && $m->id != $mesa->id)
                return redirect()->route('distribucionmesas.show', $request->distribucion_id)->with('aviso', 'Debe indicar una mesa que no exista');
        }

         $mesa->update();

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
        Factura::find($mesa->factura_id)->delete();
        $mesa->delete();
        return redirect()->back()->with('mensaje','Mesa borrada correctamente');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Distribucion;
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
    public function store(Request $request)
    {
        //
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
    public function update(Request $request, Mesa $mesa)
    {
         /*$res = array('msg'=>"Algo ha ido mal");
         $data = $request->all();

         $save = $mesa->update($data);

         if($save){
             $res = array('msg' => 'Form data successfully updated');
         }
         return response()->json($res);*/

         $request->validate([
            'num_asientos' => ['required'],
        ]);

        $mesa->update($request->all());
        $distribucionmesa = DB::table('distribucions')->find($mesa->distribucion_id);
        $mesas = Mesa::where('distribucion_id', $distribucionmesa->id)
        ->paginate(6)->withQueryString();

        return view('distribucionmesas.detalles', compact('distribucionmesa','mesas'));

         $message = 'La mesa '.$mesa->id.' ha sido editada correctamente.';

         if($request->ajax()){
            return response()->json([
                'num_asientos'=>$mesa->num_asientos,
                'message'=>$message
            ]);
         }

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

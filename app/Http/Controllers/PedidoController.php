<?php

namespace App\Http\Controllers;

use App\Http\Requests\PedidoRequest;
use App\Models\Bebida;
use App\Models\Distribucion;
use App\Models\Factura;
use App\Models\Mesa;
use App\Models\Pedido;
use App\Models\Tapa;
use Illuminate\Support\Facades\DB;
use PDF;
class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pedidos = Pedido::all();
        return view('pedidos.index', compact('pedidos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Mesa $mesa, Distribucion $distribucionmesa)
    {
        if($distribucionmesa->user_id != auth()->user()->id || $mesa->distribucion_id != $distribucionmesa->id)
            return redirect()->back()->with('aviso', '¡Solo puedes acceder a tus pedidos!');
        else
            return view('pedidos.create', compact('mesa'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PedidoRequest $request)
    {

        $pedido = new Pedido();
        $pedido->estado_id=$request->estado_id;

        if($request->tapa_id!="Selecciona un plato") {
            $arr = explode('|',$request->tapa_id);
            $pedido->tapa_id=$arr[0];
        }else
            $pedido->tapa_id=null;

        if($request->bebida_id!="Selecciona una bebida")
            $pedido->bebida_id=$request->bebida_id;
        else
            $pedido->bebida_id=null;
        $pedido->cantidad=$request->cantidad;
        $pedido->mesa_id=$request->mesa_id;

        $tapa = DB::table('tapas')->find($pedido->tapa_id);
        $bebida = DB::table('bebidas')->find($pedido->bebida_id);

        if($tapa!=null && $tapa->tipotapa_id==2 && $bebida!=null) {
            return redirect()->back()->with('aviso', 'Las raciones deben pedirse sin bebida');
        }
        $pedido->total_pedido=0;
        for($i=0;$i<($pedido->cantidad);$i++){
            if($bebida!=null){
                if($bebida->tipobebida_id==1 || $tapa==null){
                    $pedido->total_pedido= $pedido->total_pedido + $bebida->precio;
                } else {
                    $pedido->total_pedido= $pedido->total_pedido + $bebida->precio + $tapa->precio;
                }
            } else if($tapa!=null)
                $pedido->total_pedido= $pedido->total_pedido + $tapa->precio;
        }


        if($pedido->tapa_id == null && $pedido->bebida_id == null){
            return redirect()->back()->with('aviso', 'Debe seleccionar una bebida o tapa');
        }else
            $pedido->save();

        return redirect()->back()->with('mensaje','Pedido realizado correctamente');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function update(PedidoRequest $request)
    {
        $pedido = Pedido::find($request->pedido_id);
        $cantidad_inicial = $pedido->cantidad;
        $estado_inicial = $pedido->estado_id;
        $tapa_inicial = $pedido->tapa_id;
        $bebida_inicial = $pedido->bebida_id;


        $pedido->estado_id=$request->estado_id;
        $pedido->cantidad=$request->cantidad;
        $pedido->tapa_id=null;
        $pedido->bebida_id=null;

        if($request->tapa_id=="Selecciona un plato") {
            $pedido->tapa_id=null;
        }else
            $pedido->tapa_id=$request->tapa_id;

        if($request->bebida_id!="Selecciona una bebida")
            $pedido->bebida_id=$request->bebida_id;

        $pedido->mesa_id=$request->mesa_id;

        $tapa = DB::table('tapas')->find($pedido->tapa_id);
        $bebida = DB::table('bebidas')->find($pedido->bebida_id);

        $pedido->total_pedido=0;
        if($tapa!=null && $tapa->tipotapa_id==2 && $bebida!=null) {
            return redirect()->back()->with('aviso', 'Las raciones deben pedirse sin bebida');
        }

        for($i=0;$i<($pedido->cantidad);$i++){
            if($bebida!=null){
                if($bebida->tipobebida_id==1 || $tapa==null){
                    $pedido->total_pedido= $pedido->total_pedido + $bebida->precio;
                } else {
                    $pedido->total_pedido= $pedido->total_pedido + $bebida->precio + $tapa->precio;
                }
            } else if($tapa!=null)
                $pedido->total_pedido= $pedido->total_pedido + $tapa->precio;
        }

        if($pedido->tapa_id == null && $pedido->bebida_id == null)
            return redirect()->back()->with('aviso', 'Debe seleccionar una bebida o tapa');
        else if ($tapa != null && $bebida != null) {
            if(($tapa->disponible == 0 || $bebida->disponible == 0) && $cantidad_inicial < $pedido->cantidad)
                return redirect()->back()->with('aviso', 'No puede aumentar la cantidad, no hay más disponible');
        } else if ($tapa != null) {
            if($tapa->disponible == 0  && $cantidad_inicial < $pedido->cantidad)
                return redirect()->back()->with('aviso', 'No puede aumentar la cantidad, no hay más disponible');
        } else if ($bebida != null) {
            if($bebida->disponible == 0  && $cantidad_inicial < $pedido->cantidad)
                return redirect()->back()->with('aviso', 'No puede aumentar la cantidad, no hay más disponible');
        }

        $pedido->update();

        $pedidos = DB::table('pedidos')->where([
                                 ['mesa_id' , $pedido->mesa_id],
                                 ['estado_id' , 4]
                                 ])->get();

        $total = 0;
        foreach ($pedidos as $ped) {
            $total += $ped->total_pedido;
        }

        $mesa=DB::table('mesas')->find($pedido->mesa_id);
        DB::table('facturas')->where('id', $mesa->factura_id)->update(['total_factura' => $total]);

        if($pedido->estado_id==4 && $estado_inicial!=4)
            return redirect()->back()->with('mensaje','Pedido actualizado con éxito y enviado a la factura');
        else if($estado_inicial == 4 && $pedido->estado_id!=4)
            return redirect()->back()->with('mensaje','Pedido actualizado con éxito y devuelto al listado');
        else
            return redirect()->back()->with('mensaje','Pedido actualizado con éxito');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pedido $pedido)
    {
        $mesa=DB::table('mesas')->find($pedido->mesa_id);
        $factura=DB::table('facturas')->find($mesa->factura_id);
        if($pedido->estado_id == 4) {
            DB::table('facturas')
                ->where('id', $factura->id)
                ->update(['total_factura' => $factura->total_factura - $pedido->total_pedido]);
        }

        $pedido->delete();

        return redirect()->back()->with('mensaje', 'Pedido borrado correctamente');
    }

    public function downloadPDF(Factura $factura) {
        $todosPedidos=$factura->pedidos;
        $pedidos = $todosPedidos->where('estado_id',4)->all();

        $pdf= PDF::loadview('pdf.pedidos',compact('pedidos','factura'));
        return $pdf->download('factura.pdf');
    }

    public function recalcularFactura(Factura $factura) {
        $todosPedidos=$factura->pedidos;
        $pedidosT = $todosPedidos->where('estado_id',4)->all();
        $cont = 0;

        foreach ($pedidosT as $ped) {
            $pedidos = Pedido::where(['mesa_id' => $pedidosT[array_key_first($pedidosT)]->mesa_id,
                                      'estado_id' => 4  ])->get();
            $cont = 0;
            foreach($pedidos as $pedido_tapa) {
                if($pedido_tapa->bebida_id==null) {
                    $tapa = Tapa::find($pedido_tapa->tapa_id);
                    if($tapa->tipotapa_id==1)
                        foreach ($pedidos as $pedido_bebida) {
                            if($pedido_bebida->tapa_id==null) {
                                $bebida = Bebida::find($pedido_bebida->bebida_id);
                                if($bebida->tipobebida_id==1) {
                                    if($pedido_tapa->cantidad == $pedido_bebida->cantidad) {
                                        Pedido::find($pedido_tapa->id)->delete();
                                        Pedido::find($pedido_bebida->id)
                                        ->update(['tapa_id'=> $tapa->id]);
                                        $cont = 1;
                                        break;

                                    } else if($pedido_bebida->cantidad > $pedido_tapa->cantidad) {
                                        $difcant = $pedido_bebida->cantidad - $pedido_tapa->cantidad;
                                        Pedido::find($pedido_tapa->id)->delete();
                                        Pedido::find($pedido_bebida->id)
                                        ->update(['tapa_id' => $tapa->id,
                                                'cantidad' => $pedido_tapa->cantidad,
                                                'total_pedido' => $bebida->precio * $pedido_tapa->cantidad ]);
                                        Pedido::create(['bebida_id'=> $bebida->id,
                                        'cantidad' => $difcant,
                                        'estado_id' => 4,
                                        'mesa_id' => $pedido_bebida->mesa_id,
                                        'total_pedido' => $bebida->precio * $difcant ]);

                                        $cont = 1;
                                        break;
                                    } else if($pedido_tapa->cantidad > $pedido_bebida->cantidad) {
                                        $difcant = $pedido_tapa->cantidad - $pedido_bebida->cantidad;
                                        Pedido::find($pedido_bebida->id)
                                        ->update(['tapa_id' => $tapa->id,
                                                'cantidad' => $pedido_bebida->cantidad,
                                                'total_pedido' => $bebida->precio * $pedido_bebida->cantidad ]);
                                        Pedido::find($pedido_tapa->id)
                                        ->update(['cantidad' => $difcant,
                                                'total_pedido' => $tapa->precio * $difcant  ]);

                                        $cont = 1;
                                        break;
                                    }
                                }
                        }
                }
            } else if ($pedido_tapa->bebida_id!=null && $pedido_tapa->tapa_id!=null) {
                foreach ($pedidos as $pedido_igual) {
                    if ($pedido_igual != null) {
                        if($pedido_tapa->id != $pedido_igual->id) {
                            if ($pedido_tapa->bebida_id == $pedido_igual->bebida_id && $pedido_tapa->tapa_id == $pedido_igual->tapa_id) {
                                Pedido::find($pedido_tapa->id)->delete();
                                Pedido::find($pedido_igual->id)->update([
                                    'cantidad' => $pedido_igual->cantidad + $pedido_tapa->cantidad,
                                    'total_pedido' => $pedido_igual->total_pedido + $pedido_tapa->total_pedido
                                ]);
                                $cont = 1;
                                break;
                            }
                        }
                    }
                }
            }
            if ($cont == 1)
                break;
        }
    }

        foreach ($pedidosT as $ped) {
            $pedidos = Pedido::where(['mesa_id' => $pedidosT[array_key_first($pedidosT)]->mesa_id,
                                        'estado_id' => 4  ])->get();
            $cont = 0;

            foreach ($pedidos as $pedido) {
                if ($pedido->tapa_id != null) {
                    $tapa = Tapa::find($pedido->tapa_id);
                    if ($tapa->tipotapa_id == 2) {
                        foreach ($pedidos as $ped_rac) {
                            if ($ped_rac->tapa_id != null) {
                                $tapar = Tapa::find($ped_rac->tapa_id);
                                if (($tapar->tipotapa_id == 2) && ($pedido->id != $ped_rac->id) && ($tapa->id == $tapar->id)) {
                                    Pedido::find($pedido->id)->delete();
                                    Pedido::find($ped_rac->id)->update([
                                        'cantidad' => $pedido->cantidad + $ped_rac->cantidad,
                                        'total_pedido' => $pedido->total_pedido + $ped_rac->total_pedido]);

                                    $cont=1;
                                    break;
                                }
                        }
                    }
                    }
                }
                if ($cont == 1)
                    break;
            }
        }



        $pedidos = Pedido::where(['mesa_id' => $pedidosT[array_key_first($pedidosT)]->mesa_id,
                                        'estado_id' => 4  ])->get();

        $total = 0;
        foreach ($pedidos as $ped) {
            $total += $ped->total_pedido;
        }

        Factura::find($factura->id)
        ->update(['total_factura' => $total]);

        return redirect()->back()->with('mensaje', 'Pedido recalculado correctamente');
    }

    public function entregarPedidos(Mesa $mesa) {
        $pedidos = DB::table('pedidos')->where([
            ['mesa_id',$mesa->id],
            ['estado_id','!=',1],
            ])->paginate(10);

        foreach ($pedidos as $ped) {
            DB::table('pedidos')->where('id', $ped->id)
            ->update(['estado_id' => 4]);
        }

        $pedidos = DB::table('pedidos')->where([
            ['mesa_id',$mesa->id],
            ['estado_id',4],
            ])->get();

        $total = 0;

        foreach ($pedidos as $ped) {
            $total += $ped->total_pedido;
        }

        Factura::find($mesa->factura_id)
        ->update(['total_factura' => $total]);


        return redirect()->back()->with('mensaje', 'Pedidos entregados');
    }
}

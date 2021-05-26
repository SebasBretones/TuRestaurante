<?php

namespace App\Http\Controllers;

use App\Models\Bebida;
use App\Models\Carta;
use App\Models\Tapa;
use Illuminate\Http\Request;
use PDF;


class CartaController extends Controller
{

    public function index(){
        return view ('cartas.index');
    }
    
    public function downloadCarta() {
        $tapas = Tapa::where('tipotapa_id',1)->orderBy('nombre')->get();
        $raciones = Tapa::where('tipotapa_id',2)->orderBy('nombre')->get();

        $bebidasC = Bebida::where('tipobebida_id',1)->orderBy('nombre')->get();
        $bebidasS = Bebida::where('tipobebida_id',2)->orderBy('nombre')->get();

        //return view('pdf.carta', compact('tapas','raciones','bebidasC','bebidasS'));
        $pdf= PDF::loadview('pdf.carta',compact('tapas','raciones','bebidasC','bebidasS'));
        return $pdf->download('carta.pdf');
    }
}

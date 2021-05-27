<?php

namespace App\Http\Controllers;

use App\Models\Bebida;
use App\Models\Carta;
use App\Models\Tapa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use PDF;


class CartaController extends Controller
{

    public function index(){
        $user = auth()->user();
        return view ('cartas.index', compact('user'));
    }

    public function generateCarta(User $user) {
        $tapas = Tapa::where([
            ['tipotapa_id',1],
            ['user_id',$user->id]
        ])->orderBy('nombre')->get();

        $raciones = Tapa::where([
            ['tipotapa_id',2],
            ['user_id',$user->id]
        ])->orderBy('nombre')->get();

        $bebidasC = Bebida::where([
            ['tipobebida_id',1],
            ['user_id',$user->id]
        ])->orderBy('nombre')->get();

        $bebidasS = Bebida::where([
            ['tipobebida_id',2],
            ['user_id',$user->id]
        ])->orderBy('nombre')->get();

        $pdf= PDF::loadview('pdf.carta',compact('tapas','raciones','bebidasC','bebidasS','user'));
        $output = $pdf->output();
        $path = public_path().'/pdf/user'.$user->id;
        File::makeDirectory($path, $mode = 0777, true, true);
        file_put_contents('pdf/user'.$user->id.'/Carta.pdf', $output);
        return redirect()->route('cartas.index')->with('mensaje' , 'Carta generada correctamente');
    }

    public function downloadCarta(User $user){
        $file = public_path()."/pdf/".$user->id."/Carta.pdf";
        $headers = array('Content-Type: application/pdf',);
        return response()->download($file, 'Carta.pdf', $headers); 
    }
}

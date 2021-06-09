<?php

namespace App\Http\Controllers;

use App\Models\Bebida;
use App\Models\Tapa;
use App\Models\User;
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
            ['user_id',1]
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

       return view('pdf.carta',compact('tapas','raciones','bebidasC','bebidasS','user'));
    }

}

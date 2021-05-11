<?php

namespace App\Http\Controllers;

use App\Models\Tapa;
use Illuminate\Http\Request;

class TapaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tapas = Tapa::orderBy('nombre')
        ->paginate(10)->withQueryString();

        return view ('tapas.index', compact('tapas'));
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
     * @param  \App\Models\Tapa  $tapa
     * @return \Illuminate\Http\Response
     */
    public function show(Tapa $tapa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tapa  $tapa
     * @return \Illuminate\Http\Response
     */
    public function edit(Tapa $tapa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tapa  $tapa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tapa $tapa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tapa  $tapa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tapa $tapa)
    {
        //
    }
}

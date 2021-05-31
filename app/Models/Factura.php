<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    use HasFactory;
    protected $fillable = ['total_factura'];

    public function pedidos()
    {
        return $this->hasManyThrough(Pedido::class, Mesa::class);
    }

    public function mesa(){
        return $this->belongsTo(Mesa::class);
    }
}

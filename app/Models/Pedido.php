<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;
    protected $fillable=['total_pedido','tapa_id','estado_id','mesa_id'];

    public function estado(){
        return $this->hasOne(Estado::class);
    }

    public function tapas(){
        return $this->hasMany(Tapa::class);
    }

    public function mesa(){
        return $this->belongsTo(Mesa::class);
    }

    public function factura(){
        return $this->belongsTo(Factura::class);
    }

}

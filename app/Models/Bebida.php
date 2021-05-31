<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bebida extends Model
{
    use HasFactory;
    protected $fillable = ['nombre','precio','tipobebida_id'];

    public function pedido(){
        return $this->belongsToMany(Pedido::class);
    }

    public function tipobebida(){
        return $this->hasOne(Tipobebida::class);
    }
}

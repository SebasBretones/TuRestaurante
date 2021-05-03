<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tapa extends Model
{
    use HasFactory;
    protected $fillable = ['nombre','tipo','precio'];

    public function pedido(){
        return $this->belongsToMany(Pedido::class);
    }
}

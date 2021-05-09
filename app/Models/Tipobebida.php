<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipobebida extends Model
{
    use HasFactory;
    protected $fillable= ['nombre'];

    public function bebida(){
        return $this->belongsToMany(Bebida::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipotapa extends Model
{
    use HasFactory;
    protected $fillable= ['nombre'];

    public function tapa(){
        return $this->belongsToMany(Tapa::class);
    }
}

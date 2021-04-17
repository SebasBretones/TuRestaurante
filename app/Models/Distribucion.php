<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Distribucion extends Model
{
    use HasFactory;
    protected $fillable=['nombre'];

    public function mesa(){
        return $this->hasMany(Mesa::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mesa extends Model
{
    use HasFactory;
    protected $fillable = ['ocupada','num_asientos', 'factura', 'distribucion_id'];

    public function distribucion(){
        return $this->belongsTo(Distribucion::class);
    }
}

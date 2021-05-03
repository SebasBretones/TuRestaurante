<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Mesa extends Model
{
    use HasFactory;
    protected $fillable = ['ocupada','num_asientos', 'factura_id', 'distribucion_id'];

    public function distribucion(){
        return $this->belongsTo(Distribucion::class);
    }

    public function pedidos(){
        return $this->hasMany(Pedido::class);
    }

    public function factura(){
        return $this->hasOne(Factura::class);
    }

    public function scopeDistribucionId ($query,$v){
        $numDist = DB::table('distribucions')->count();
        if(!isset($v)){
            return $query->where('distribucion_id','like','%');
        }
            Switch($v){
                case 1:
                    return $query->where('distribucion_id','like','1');
                case 2:
                    return $query->where('distribucion_id','like','2');
                case 3:
                    return $query->where('distribucion_id','like','3');
            }
        }
}

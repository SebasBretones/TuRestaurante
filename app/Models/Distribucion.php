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

    public function scopeId ($query,$v){
        if(!isset($v)){
            return $query->where('id','like','%');
        }
            Switch($v){
                case 1:
                    return $query->where('id','like','1');
                case 2:
                    return $query->where('id','like','2');
                case 3:
                    return $query->where('id','like','3');
            }
        }
}

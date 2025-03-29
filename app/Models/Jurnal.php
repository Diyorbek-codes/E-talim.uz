<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurnal extends Model
{
    protected $with = ['fanlar', 'getMavzus', 'guruh'];
    use HasFactory;
    protected $guarded=[];

    public function fanlar(){
        return $this->belongsTo(Fanlar::class);
    }
    public function uquv_yili_ohtm(){
        return $this->belongsTo(Uquv_yili_ohtm::class);
    }
    public function guruh(){
        return $this->hasOne(Guruh::class, 'id', 'guruh_id');
    }
    public function getMavzus(){
        return $this->hasMany(Mavzu::class, 'jurnal_id', 'id');
    }
    public function getFanlar(){
        return $this->hasOne(Fanlar::class, 'id', 'fanlar_id');
    }

}

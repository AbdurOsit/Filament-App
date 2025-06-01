<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Faktur extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = ['id'];
    protected $table = 'faktur';

    public function customer(){
        return $this->belongsTo(CustomerModel::class);
    }

    public function detail(){
        return $this->hasMany(Detail::class,'faktur_id');
    }

    public function penjualan(){
        return $this->hasMany(PenjualanModel::class,'faktur_id');
    }
}

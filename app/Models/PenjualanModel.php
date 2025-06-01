<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class PenjualanModel extends Model
{
    use HasFactory;
    protected $guarded = ['id'] ; 
    protected $table = 'penjualan';

    public function customer(){
        return $this->belongsTo(CustomerModel::class);
    }
    public function faktur(){
        return $this->belongsTo(Faktur::class,'id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'detail';

    public function barang(){
        return $this->belongsTo(Barang::class);
    }

    public function faktur(){
        return $this->belongsTo(Faktur::class);
    }
}

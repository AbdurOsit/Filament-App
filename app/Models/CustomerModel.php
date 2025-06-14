<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerModel extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'customer';

    public function faktur(){
        return $this->hasMany(Faktur::class);
    }
}

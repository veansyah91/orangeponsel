<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = ['nama','alamat','hp'];

    public function product()
    {
        return $this->hasMany('App\Model\Product');
    }
}

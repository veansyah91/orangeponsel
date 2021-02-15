<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CreditPartner extends Model
{
    protected $fillable = ['nama_mitra','alamat'];

    public function creditAplication()
    {
        $this->hasMany('App\Model\CreditAplication');
    }
}

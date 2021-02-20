<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CreditPartner extends Model
{
    protected $fillable = ['nama_mitra','alamat','alias'];

    public function creditAplication()
    {
        return $this->hasMany('App\Model\CreditAplication');
    }

    public function user()
    {
        return $this->hasMany('App\Model\CreditSales');
    }
}

<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CreditCustomer extends Model
{
    protected $fillable = ['nama','no_ktp','no_kk','jenis_kelamin','alamat','no_hp','outlet_id'];

    public function creditAplication()
    {
        $this->hasMany('App\Model\CreditAplication');
    }

    public function outlet()
    {
        $this->belongsTo('App\Model\Outlet');
    }

}

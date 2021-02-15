<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CreditAplication extends Model
{
    protected $fillable = ['credit_customer_id','merk','tenor','dp','angsuran','status','credit_partner_id','email','password'];

    public function creditCustomer()
    {
        $this->belongsTo('App\Model\CreditCustomer');
    }

    public function creditPartner()
    {
        $this->belongsTo('App\Model\CreditPartner');
    }
}

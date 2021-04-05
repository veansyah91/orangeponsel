<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CreditApplication extends Model
{
    protected $fillable = ['credit_customer_id','merk','tenor','dp','angsuran','status','credit_partner_id','email','password'];

    public function creditCustomer()
    {
        return $this->belongsTo('App\Model\CreditCustomer');
    }

    public function creditPartner()
    {
        return $this->belongsTo('App\Model\CreditPartner');
    }

    public function credtiInvoice()
    {
        return $this->hasOne('App\Model\CreditInvoice');
    }
}

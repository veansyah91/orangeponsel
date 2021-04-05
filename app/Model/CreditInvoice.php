<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CreditInvoice extends Model
{
    protected $fillable = ['credit_application_id','harga','status','product_id'];

    public function creditApplication()
    {
        return $this->hasOne('App\Model\CreditApplication');
    }
}

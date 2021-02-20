<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CreditSales extends Model
{
    protected $fillable = ['user_id', 'partner_id'];
    
    public function partner()
    {
        return $this->belongsTo('App\Model\CreditPartner');
    }
}

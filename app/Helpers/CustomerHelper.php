<?php
namespace App\Helpers;

use Illuminate\Support\Facades\DB;
use App\Model\Customer;

class CustomerHelper {
    public static function getName($id) {
        return $customer= Customer::where('id', $id)->first();
        
    }
}
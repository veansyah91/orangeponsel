<?php

namespace App\Helpers;

use App\Model\OutletUser;
use Illuminate\Support\Facades\DB;

class UserHelper {
    public static function getOutletUser($userId)
    {
        return $outlet = OutletUser::where('user_id', $userId)->get();
        
    }
}
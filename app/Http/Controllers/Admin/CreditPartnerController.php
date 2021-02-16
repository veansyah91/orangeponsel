<?php

namespace App\Http\Controllers\Admin;

use App\Model\CreditPartner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CreditPartnerController extends Controller
{
    public function index()
    {
        return view('admin.credit.credit-partner');
    }

    public function proposal($partner)
    {
        return view('admin.credit.credit-application',['partner' => $partner]);
    }
}
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CreditPartnerController extends Controller
{
    public function index()
    {
        return view('admin.credit.credit-partner');
    }
}

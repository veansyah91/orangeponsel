<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DebtController extends Controller
{
    public function index()
    {
        return view('admin.daily.debt.index');
    }
}

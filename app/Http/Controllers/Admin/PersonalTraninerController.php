<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PersonalTraninerController extends Controller
{
    public function index()
    {
        return view('admin.pt');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class arsipController extends Controller
{
    public function index()
    {
        return view('arsip.index');
    }
}

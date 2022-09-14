<?php

namespace App\Http\Controllers;
use App\Arsip;
use App\About;
use Illuminate\Http\Request;

class arsipController extends Controller
{
    public function index()
    {
        $arsip = Arsip::all();
        return view('arsip.index', ['arsip' => $arsip]);
    }
}

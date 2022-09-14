<?php

namespace App\Http\Controllers;
use App\Arsip;
use App\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class arsipController extends Controller
{
    public function index()
    {
        $arsip = Arsip::all();
        return view('arsip.index', ['arsip' => $arsip]);
    }

    public function create()
    {
        $kategori = Kategori::all();
        return view('arsip.create', ['kategori' => $kategori]);
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nomor_surat' => ['required', 'unique:users'],
        ]);
    }

    public function store(Request $request)
    {
        $file_surat = new Arsip();
       $this->validate($request, [
            'file_surat' => 'required|file|mimes:pdf',
        ]);
        if($request->hasfile('file_surat'))
         {
            $file = $request->file('file_surat');
            $name = $file->getClientOriginalName();
          
            $folder = '/public/files/';
            $path = $folder.$name;
            $file->move('public/files',$name);
            $file_surat->file_surat = $path;
         }
        // $file_surat = $request->file('file_surat');
        // $nama_file = $file_surat->getClientOriginalExtension();
        // $file_surat->move('public/files/',$nama_file);

        // $data = new Arsip();
        $file_surat->nomor_surat = $request->nomor_surat;
        $file_surat->id_kategori = $request->kategori;
        $file_surat->judul = $request->judul;
        $file_surat->file_surat = $name;
        $file_surat->save();
        return redirect()->route('arsip')->with('success','Data berhasil disimpan');
    }

    // public function show($id)
    // {
    //     $dl = Arsip::find($id);
    //     return response()->download(storage_path("app/public/{$dl->file_surat $dl->judul}"));
    // }
}

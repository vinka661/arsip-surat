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

    public function show($id_arsip)
    {
        $arsip = Arsip::find($id_arsip);
        $kategori = Kategori::all();
        return view('arsip.show', ['arsip' => $arsip, 'kategori' => $kategori]);
    }

    public function edit($id_arsip)
    {
        $arsip = Arsip::find($id_arsip);
        $kategori = Kategori::all();
        return view('arsip.edit', ['arsip' => $arsip, 'kategori' => $kategori]);
    }

    public function update(Request $request, $id_arsip)
    {
        $arsip = Arsip::find($id_arsip);
        $this->validate($request, [
            'file_surat' => 'required|file|mimes:pdf',
        ]);
        // $upload->id_rcfa = $request->id_rcfa;
        // $upload->keterangan_kajian = $request->keterangan_kajian;
        if($arsip->file_surat && file_exists(storage_path('/public/files/' . $arsip->file_surat)))
        {
            \Storage::delete('/public/files/'.$arsip->file_surat);
        }
        if($request->hasfile('file_surat'))
         {
            $file = $request->file('file_surat');
            $name = $file->getClientOriginalName();
          
            $folder = '/public/files/';
            $path = $folder.$name;
            $file->move('public/files',$name);
            $arsip->file_surat = $path;
         }
        $arsip->file_surat = $name;
        $arsip->save();
        return redirect()->route('show', ['id_arsip' => $request->id_arsip])->with('success','File berhasil diupdate');
    }

    public function delete($id_arsip)
    {
        $arsip = Arsip::find($id_arsip);
        $arsip->delete();
        return redirect('arsip')->with('success','Data berhasil dihapus');
    }
}

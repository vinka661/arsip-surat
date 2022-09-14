<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Arsip extends Model
{
    public $table = "arsips";
    protected $fillable = ['nomor_surat', 'judul', 'id_kategori', 'file_surat', 'created_at'];
    protected $primaryKey = 'id_arsip';

    public function kategori()
    {
        return $this->belongsTo('App\Kategori', 'id_kategori');
    }
}
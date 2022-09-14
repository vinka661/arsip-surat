<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    public $table = "kategoris";
    protected $fillable = ['nama_kategori'];
    protected $primaryKey = 'id_kategori';

    public function arsip()
    {
        return $this->hasMany('App\Arsip');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_kasir',
        'nama',
        'deskripsi',
        'harga',
        'stok',
        'image'

    ];

    public function Kasir()
    {
        return $this->belongsTo(Kasir::class, 'id_kasir');
    }

    public function pesanan_detail() 
	{
	     return $this->hasMany('App\Models\PesananDetail','produk_id', 'id');
	}
}

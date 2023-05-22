<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['uuid', 'nama', 'slug', 'kategori_id', 'price', 'status', 'menit', 'image', 'deskripsi'];

    public function kategori(){
        return $this->belongsTo(KategoriProduk::class, 'kategori_id');
    }
}

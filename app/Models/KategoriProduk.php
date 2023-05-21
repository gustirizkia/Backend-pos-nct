<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriProduk extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'uuid', 'vendor_uuid', 'slug'];

    public function produk(){
        return $this->hasMany(Product::class, 'kategori_id');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KategoriProduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class KategoriProdukController extends Controller
{
    public function createKategoriProduk(Request $request){
        $validasi = Validator::make($request->all(), [
            'name' => 'required|string',
            'vendor_uuid' => 'required|exists:vendors,uuid'
        ]);

        if($validasi->fails()){
            return redirect()->back()->with('error', "Add new kategori failed. ".$validasi->errors()->first());
        }

        $slug = Str::slug($request->name);
        $slug = KategoriProduk::where('slug', $slug)->first() ? $slug."-".Str::random(6) : $slug;

        $data = KategoriProduk::create([
            'name' => $request->name,
            'slug' => $slug,
            'vendor_uuid' => $request->vendor_uuid,
        ]);

        return redirect()->back()->with('success', 'Berhasil tambah kategori produk');

    }
}

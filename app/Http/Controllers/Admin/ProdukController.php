<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KategoriProduk;
use App\Models\Product;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vendor = Vendor::where('user_uuid', auth()->user()->uuid)->first();
        $kategori = KategoriProduk::where('vendor_uuid', $vendor->uuid);
        $produk = Product::whereIn('kategori_id', $kategori->pluck('id'))->with('kategori')->get();
        return view('pages.admin.produk.index', [
            'produk' => $produk,
            'kategori' => $kategori->get(),
            'vendor' => $vendor
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $vendor = Vendor::where('user_uuid', auth()->user()->uuid)->first();
        $kategori = KategoriProduk::where('vendor_uuid', $vendor->uuid)->get();
        return view('pages.admin.produk.create', [
            'kategori' => $kategori,
            'vendor' => $vendor
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'kategori_id' => 'required|exists:kategori_produks,id',
            'image' => 'required|image|max:4048', // 4mb
            'price' => 'required|integer',
            'deskripsi' => 'required|string'
        ]);

        if($validasi->fails()){
            return redirect()->back()->with('error', "Add new produk failed ".$validasi->errors()->first());
        }

        $image = $request->image->store('produk/images', 'public');

        $slug = Str::slug($request->nama);
        $cekSlug = Product::where('slug', $slug)->first() ? $slug."-".Str::random(3) : $slug;

        $insert = Product::create([
            'nama' => $request->nama,
            'image' => $image,
            'kategori_id' => $request->kategori_id,
            'slug' => $cekSlug,
            'uuid' => generateUuid('products', 12),
            'price' => $request->price,
            'deskripsi' => $request->deskripsi
        ]);

        return redirect()->route('admin-produk.index')->with('success', "Berhasil tambah produk");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Product::where('uuid', $id)->delete();

        return redirect()->back()->with('success', 'Berhasil hapus data');
    }
}

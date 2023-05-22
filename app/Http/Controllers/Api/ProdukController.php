<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\KategoriProduk;
use App\Models\Meja;
use App\Models\Product;
use App\Models\VendorStore;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(!$request->store_id){
            return response()->json([
                'message' => 'data not found',
                $request->all()
            ], 404);
        }

        $cekStore = VendorStore::where('uuid', $request->store_id)->first();
        if(!$cekStore){
            return response()->json([
                'message' => 'store not found'
            ], 404);
        }

        $cekMeja = Meja::where('uuid', $request->meja)->where('uuid_store', $cekStore->uuid)->first();
        if(!$cekMeja){
            return response()->json([
                'message' => 'meja store not found'
            ], 404);
        }

        $kategoriStore =  KategoriProduk::where('vendor_uuid', $cekStore->uuid_vendor)->get()->pluck('id');
        // dd($kategoriStore);

        if($request->kategori){
            $kategori =  KategoriProduk::where('id', $request->kategori)->first();
            if($kategori){
                $produk = Product::where('kategori_id', $request->kategori)->get();
            }else{
                $produk = Product::whereIn('kategori_id', $kategoriStore)->get();
            }
        }else{
            $produk = Product::whereIn('kategori_id', $kategoriStore)->get();
        }

        $kategoriStore =  KategoriProduk::where('vendor_uuid', $cekStore->uuid_vendor)->get();


        return response()->json([
            'success' => true,
            'data' => $produk,
            'kategori' => $kategoriStore,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
    }
}

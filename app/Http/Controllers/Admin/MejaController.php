<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Meja;
use App\Models\VendorStore;
use Illuminate\Http\Request;

class MejaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->store_id){
            $store = VendorStore::where('uuid', $request->store_id)->first();

            if(!$store){
                return abort(404);
            }

            $meja = Meja::where('uuid_store', $store->uuid)->orderBy('nomor_meja', 'asc')->get();

            return view('pages.admin.meja.index', [
                'meja' => $meja,
                'store' => $store
            ]);
        }else{
           return abort(404);
        }
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
        $request->validate([
            'nomor_meja' => 'required|string'
        ]);

        $data = Meja::create([
            'nomor_meja' => $request->nomor_meja,
            'uuid' => generateUuid('mejas', 12),
            'uuid_store' => $request->uuid_store
        ]);

        return redirect()->back()->with('success', "Berhasil tambah data");
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
        $request->validate([
            'nomor_meja' => 'required|string'
        ]);

        $update = Meja::where('id', $id)->update([
            'nomor_meja' => $request->nomor_meja
        ]);

        return redirect()->back()->with('success', "Berhasil update data");

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

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vendor;
use App\Models\VendorStore;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $vendor = Vendor::where('user_uuid', auth()->user()->uuid)->first();

        $storeVendor = VendorStore::where('uuid_vendor', $vendor->uuid)->withCount('admin')->get();
        // dd($storeVendor);

        return view('pages.admin.store.index', [
            'stores' => $storeVendor
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.store.create');
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
            'image' => 'required|image|max:4048',
            'name' => 'required|string'
        ]);

        $image = $request->image->store('store/images', 'public');

        $vendor = Vendor::where('user_uuid', auth()->user()->uuid)->first();

        $store = VendorStore::create([
            'uuid' => generateUuid('vendor_stores', 12),
            'uuid_vendor' => $vendor->uuid,
            'name' => $request->name,
            'image' => $image,
            'status' => $request->status
        ]);

        return redirect()->route('store.index')->with('success', "Berhasil tambah store");
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
        $data = VendorStore::where('uuid', $id)->first();

        return view('pages.admin.store.edit', [
            'data' => $data
        ]);
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
            'image' => 'image|max:4048',
            'name' => 'required|string'
        ]);

        $data = [
            'name' => $request->name,
            'status' => $request->status
        ];

        if($request->image){
            $data['image'] = $request->image->store('store/images', 'public');
        }

        $data = VendorStore::where('uuid', $id)->update($data);

        return redirect()->route('store.index')->with('success', "Berhasil update data");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vendor = VendorStore::where('uuid', $id)->delete();

        return redirect()->back()->with('berhasil Hapus data');
    }
}

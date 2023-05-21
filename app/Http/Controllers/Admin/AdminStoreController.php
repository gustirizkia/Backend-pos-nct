<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminStore;
use App\Models\User;
use App\Models\Vendor;
use App\Models\VendorStore;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminStoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $vendor = Vendor::where('user_uuid', auth()->user()->uuid)->first();
        $store = DB::table('vendor_stores')->where('uuid_vendor', $vendor->uuid);

        $search = $request->search;
        if($search){
            // dd($search);
            $adminStore = AdminStore::whereIn('store_uuid', $store->pluck('uuid'))
                        ->whereHas('user', function($query)use($search){
                            return $query->where('email', "LIKE", "%$search%")->orWhere('name', "LIKE", "%$search%");
                        })
                        ->with(['store', 'user'])->get();
        }else{
            $adminStore = AdminStore::whereIn('store_uuid', $store->pluck('uuid'))->with(['store', 'user'])->get();
        }


        return view('pages.admin.admin store.index', [
            'admins' => $adminStore,
            'stores' => $store->get()
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
        $store = DB::table('vendor_stores')->where('uuid_vendor', $vendor->uuid)->get();

        return view('pages.admin.admin store.create', [
            'stores' => $store
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
        $request->validate([
            'name' => 'required|string',
            'password' => 'required|string|confirmed|',
            'email' => 'required|email|unique:users,email',
            'store_uuid' => 'required|exists:vendor_stores,uuid'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'uuid' => generateUuid('users', 12)
        ]);

        $adminStore = AdminStore::create([
            'user_uuid' => $user->uuid,
            'store_uuid' => $request->store_uuid,
        ]);

        return redirect()->route('admin-store.index')->with('success', "Berhasil tambah admin store");


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
        $data = AdminStore::with(['user', 'store'])->find($id);
        $vendor = Vendor::where('user_uuid', auth()->user()->uuid)->first();
        $store = DB::table('vendor_stores')->where('uuid_vendor', $vendor->uuid)->get();

        return view('pages.admin.admin store.edit', [
            'stores' => $store,
            'item' => $data
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
        $validate = [
            'name' => 'required|string',
            'email' => 'required|email',
            'store_uuid' => 'required|exists:vendor_stores,uuid'
        ];

        $dataUser = [
            'email' => $request->email,
            'name' => $request->name
        ];

        if($request->password){
            $validate['password'] = 'required|string|confirmed';
            $dataUser['password'] = Hash::make($request->password);
        }

        $data = AdminStore::with('user')->find($id);

        if($data->user->email !== $request->email){
            $validate['email'] = 'required|email|unique:users,email';
        }

        $request->validate($validate);

        $data->update([
            'store_uuid' => $request->store_uuid
        ]);

        $user = User::where('uuid', $data->user_uuid)->update($dataUser);

        return redirect()->route('admin-store.index')->with('success', "Berhasil update data");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = AdminStore::where('id', $id)->first();
        $user = User::where('uuid', $data->user_uuid)->delete();
        $data->delete();

        return redirect()->back()->with('success', "Berhasil hapus data");
    }
}

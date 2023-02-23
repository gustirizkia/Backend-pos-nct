<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(!$request->meja_id){
            return response()->json([
                'message' => 'data not found',
                $request->all()
            ], 404);
        }
        $date = new Carbon;

        $cart = Cart::where('meja_uuid', $request->meja_id)
                ->join('products', 'carts.produk_uuid', 'products.uuid')
                ->where('carts.updated_at', '>=',Carbon::today()->subHours(1))->get();

        $count = DB::table('carts')->where('meja_uuid', $request->meja_id)->where('carts.updated_at', '>=', $date->subHours(1))->sum('qty');
        $harga = 0;

        $menit = Cart::where('meja_uuid', $request->meja_id)
                ->join('products', 'carts.produk_uuid', 'products.uuid')
                ->where('carts.updated_at', '>=',Carbon::today()->subHours(1))
                ->sum('menit');

        foreach($cart as $item){
            $harga += $item->price*$item->qty;
        }

        return response()->json([
            'data' => $cart,
            'count' => (int)$count,
            'harga' => (int)$harga,
            'menit' => $menit
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
        if(!$request->meja_id || !$request->produk_id){
            return response()->json([
                'message' => 'data not found',
                $request->all()
            ], 404);
        }

        $cart = Cart::where('meja_uuid', $request->meja_id)
            ->where('produk_uuid', $request->produk_id)
            ->where('updated_at', '>=',Carbon::today()->subHours(1))
            ->first();
        if($cart){
            if($request->min){
                $qty = $cart->qty-1;
                if($qty < 1){
                    $cart = Cart::where('meja_uuid', $request->meja_id)
                    ->where('produk_uuid', $request->produk_id)
                    ->where('updated_at', '>=',Carbon::today()->subHours(1))
                    ->delete();
                }else{
                    $cart->update([
                        'qty' => $qty
                    ]);
                }
            }else{
                $cart->update([
                    'qty' => $cart->qty+1
                ]);
            }
        }else{
            $cart = Cart::where('meja_uuid', $request->meja_id)->create([
                'meja_uuid' => $request->meja_id,
                'produk_uuid' => $request->produk_id,
                'qty' => 1
            ]);
        }

        $cart = Cart::where('meja_uuid', $request->meja_id)->where('produk_uuid', $request->produk_id)->whereDate('created_at', Carbon::today())->first();

        return response()->json([
            'data' => $cart
        ]);
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

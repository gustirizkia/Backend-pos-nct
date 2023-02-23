<?php

namespace Database\Seeders;

use App\Models\Vendor;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class VendorStoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vendor = Vendor::first();

        for ($i=1; $i < 4; $i++) {

            $store = DB::table('vendor_stores')->insertGetId([
                    'name' => 'GUSMA '.$i,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'uuid_vendor' => $vendor->uuid,
                    'uuid' => Str::uuid(),
                    'status' => 'active'
                ]);
            $getStore = DB::table('vendor_stores')->find($store);

            for ($ja=1; $ja < 5; $ja++) {
                $kategori = DB::table('kategoris')->insertGetId([
                    'nama' => 'Kategori '.$ja,
                    'slug' => "kategori-$ja",
                    'created_at' => now(),
                    'updated_at' => now(),
                    'store_uuid' => $getStore->uuid,

                ]);
            }
        }
    }
}

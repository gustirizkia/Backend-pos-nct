<?php

namespace Database\Seeders;

use App\Models\Vendor;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class VendorStoreKategoriSeeder extends Seeder
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
            DB::table('vendor_stores')->insert([
                'nama' => 'GUSMA AEON',
                'created_at' => now(),
                'updated_at' => now(),
                'uuid_vendor' => $vendor->uuid,
                'uuid' => Str::uuid(),
                'status' => 'active'
            ]);
        }
    }
}

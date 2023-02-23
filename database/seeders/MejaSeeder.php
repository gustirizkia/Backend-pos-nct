<?php

namespace Database\Seeders;

use App\Models\VendorStore;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MejaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $store = VendorStore::get();

        foreach($store as $item){
            for ($i=1; $i < 5; $i++) {
                DB::table('mejas')->insert([
                    'created_at' => now(),
                    'updated_at' => now(),
                    'nomor_meja' => $i,
                    'uuid_store' => $item->uuid,
                    'uuid' => \Str::uuid(),
                    'status' => 'active'
                ]);
            }
        }
    }
}

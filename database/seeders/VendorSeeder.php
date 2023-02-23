<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class VendorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::first();

        DB::table('vendors')->insert([
            'nama' => 'PT GUSMA CITA INDONESIA',
            'created_at' => now(),
            'updated_at' => now(),
            'user_uuid' => $user->uuid,
            'status' => 'active',
            'uuid' => Str::uuid()
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        $items = DB::table('kategoris')->get();
        foreach($items as $index => $item){
            for ($i=1; $i < 6; $i++) {
                $faker = Faker::create();
                $faker->addProvider(new \FakerRestaurant\Provider\en_US\Restaurant($faker));
                $nama = $faker->foodName();
                $slug = $nama;
                if($index > 3){
                    DB::table('products')->insertGetId([
                        'price' => $i*6000,
                        'uuid' => Str::uuid(),
                        'kategori_id' => $item->id,
                        'slug' => $slug,
                        'nama' => $nama,
                        'created_at' => now(),
                        'updated_at' => now(),
                        'menit' => $i+1,
                        'image' => $faker->imageUrl($width = 640, $height = 480)
                    ]);
                }else{
                   $faker = Faker::create();
                    $faker->addProvider(new \FakerRestaurant\Provider\en_US\Restaurant($faker));
                    $nama = $faker->fruitName();
                    $slug = $nama;

                    DB::table('products')->insertGetId([
                        'price' => $i*6000,
                        'uuid' => Str::uuid(),
                        'kategori_id' => $item->id,
                        'slug' => $slug,
                        'nama' => $nama,
                        'created_at' => now(),
                        'updated_at' => now(),
                        'menit' => $i+1,
                        'image' => $faker->imageUrl($width = 640, $height = 480)
                    ]);

                }
            }
        }

    }
}

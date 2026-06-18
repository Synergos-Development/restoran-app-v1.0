<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReviewSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('reviews')->insert([
            [
                'name' => 'Aisyah',
                'rating' => 5,
                'message' => 'Makanan enak dan pelayanannya ramah. Suasana cozy!',
                'approved' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Budi',
                'rating' => 4,
                'message' => 'Menu variatif dan harga sesuai. Recommended.',
                'approved' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Citra',
                'rating' => 5,
                'message' => 'Sempurna untuk acara keluarga. Atmosfernya mantap.',
                'approved' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}

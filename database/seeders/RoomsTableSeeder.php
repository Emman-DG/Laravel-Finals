<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use App\Models\Room;
use Illuminate\Database\Seeder;

class RoomsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('rooms')->insert([
            [
                'room_number' => 101,
                'room_type' => 'Single',
                'description' => 'Single room with one bed',
                'capacity' => 1,
                'price_per_night' => 50.00,
                'availability_status' => true,
            ],
            [
                'room_number' => 102,
                'room_type' => 'Double',
                'description' => 'Double room with two beds',
                'capacity' => 2,
                'price_per_night' => 75.00,
                'availability_status' => true,
            ],
            [
                'room_number' => 201,
                'room_type' => 'Suite',
                'description' => 'Suite room with a king-size bed and amenities',
                'capacity' => 4,
                'price_per_night' => 150.00,
                'availability_status' => false,
            ],
        ]);
    }
}

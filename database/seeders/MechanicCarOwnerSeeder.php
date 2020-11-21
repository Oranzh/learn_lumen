<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MechanicCarOwnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('mechanics')->insert(['name' => 'Nancy']);
        $mechanic_id = DB::table('mechanics')->max('id');

        DB::table('cars')->insert([
            'model' => 'AMG',
            'mechanic_id' => $mechanic_id,
        ]);
        $car_id = DB::table('cars')->max('id');

        DB::table('owners')->insert([
            'name' => 'AMG Owner',
            'car_id' => $car_id,
        ]);
    }
}

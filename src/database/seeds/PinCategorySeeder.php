<?php

use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PinCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $foodArray = ["weekly", "monthly", "daily"];

        foreach ($foodArray as $food) {
            DB::table('pin_categories')->insert([
                'category_name' => $food,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()

            ]);
        }
    }
}

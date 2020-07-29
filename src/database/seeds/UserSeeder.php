<?php

use App\User;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $user = User::create([
        //     // 'id' => Uuid::generate(),

        //     'name' => 'Seyi John',

        //     'email' => 'seyi.john@gmail.com',

        //     'password' => bcrypt('secret')

        // ]);


        DB::table('users')->insert([
            'name' => 'Seyi John',

            'email' => 'seyi.john@gmail.com',

            'password' => bcrypt('secret'),

            'phone_number' => '08026425250',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()

        ]);
    }
}

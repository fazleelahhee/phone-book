<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PhoneBookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = DB::table('users')->get();
        foreach($users as $user) {
            for($i=0; $i<30; $i++) {
                $faker = Faker\Factory::create();
                DB::table('phone_books')->insert([
                    'name' => $faker->name,
                    'telephone' => $faker->phoneNumber,
                    'mobile' => $faker->phoneNumber,
                    'user_id' => $user->id
                ]);
            }
        }
    }
}

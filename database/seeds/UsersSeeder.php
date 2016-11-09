<?php

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\User::create([
            'c_name' => '엘씨벤처스',
            'm_name' => '김수겸',
            'm_email'=>'ikks06luck@naver.com',
            'c_id' => "admin",
            'phone' => '01012345678',
            'password' => bcrypt('admin'),
            'status' => true,
            'role' => 1
        ]);
    }
}

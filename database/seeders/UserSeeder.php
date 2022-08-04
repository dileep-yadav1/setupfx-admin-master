<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Hash; 

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Super Admin',
            'email' => 'admin@setupfx.com',
            'password' => Hash::make('123456'),
            'role_id' => '1',
            'status' => '1',
            'dob' => '1988-02-02 00:00:00',
            'email_verified_at'=>'2022-01-02 17:04:58',
            'avatar' => 'images/avatar-1.jpg',
            'created_at' => now(),
            'created_by' => 1,
            'updated_by' => 1,      
            'updated_at' => now(),
        ]);
    }
}
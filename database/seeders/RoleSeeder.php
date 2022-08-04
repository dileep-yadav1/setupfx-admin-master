<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'name' => 'Super Admin',   
            'guard_name' => 'web',  
            'created_at' => now(),       
            'updated_at' => now(),
        ]);
        DB::table('roles')->insert([
            'name' => 'Admin',     
            'guard_name' => 'web',
            'created_at' => now(),       
            'updated_at' => now(),
        ]);
        DB::table('roles')->insert([
            'name' => 'Client',   
            'guard_name' => 'web',  
            'created_at' => now(),       
            'updated_at' => now(),
        ]);
        DB::table('roles')->insert([
            'name' => 'IB',     
            'guard_name' => 'web',
            'created_at' => now(),       
            'updated_at' => now(),
        ]);
        DB::table('roles')->insert([
            'name' => 'Super Admin Staff', 
            'guard_name' => 'web',    
            'created_at' => now(),       
            'updated_at' => now(),
        ]);
        DB::table('roles')->insert([
            'name' => 'Admin Staff', 
            'guard_name' => 'web',    
            'created_at' => now(),       
            'updated_at' => now(),
        ]);
    }
}

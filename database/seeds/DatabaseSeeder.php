<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //Seed the first role table
        DB::table('roles')->insert([
            'name' => 'Administrator' 
        ]);

        //Seed the first user
        DB::table('users')->insert([
            'name' => 'SuperAdmin',
            'password' => Hash::make('authorize'),
            'role' => '1'
        ]);
    }
}

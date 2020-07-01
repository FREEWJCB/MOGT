<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash; // para encryptar
use Illuminate\Support\Str; // para random

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insertOrIgnore([
        ['id' => 1, 'name' => 'admin', 'email' => 'admin@gmail.com','password' => Hash::make(123456)],
        ['id' => 2, 'name' => 'dan', 'email' => 'vasquezpinedaj@gmail.com','password' => Hash::make(562738194)],
        ['id' => 3, 'name' => Str::random(10), 'email' => Str::random(10).'@gmail.com','password' => Hash::make('password')],
        ['id' => 4, 'name' => Str::random(10), 'email' => Str::random(10).'@gmail.com','password' => Hash::make('password')],
        ['id' => 5, 'name' => Str::random(10), 'email' => Str::random(10).'@gmail.com','password' => Hash::make('password')]
      ]);
    }
}

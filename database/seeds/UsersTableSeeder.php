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

        // Solucionando error de la id
        DB::statement("SELECT setval(pg_get_serial_sequence('users', 'id'), coalesce(max(id)+1,1), false) FROM users;");
        // El error sucede ya que postgresql al solo implantarle datos sin espicifarle que incremente la id
        // postgresql hara como que la id sigue siendo 1
    }
}

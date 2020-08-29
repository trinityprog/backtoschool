<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'type' => 'admin',
            'email' => 'support@duke.kz',
            'password' => bcrypt('password'),
            'remember_token' => Str::random(10),
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);
        DB::table('users')->insert([
            'name' => 'Duke',
            'email' => '+374 70 52 01 01',
            'password' =>Str::random(12),
            'remember_token' => Str::random(10),
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);
        // $this->call(UserSeeder::class);
    }
}

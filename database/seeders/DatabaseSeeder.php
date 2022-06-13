<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(settingTableSeeder::class);
    }
}

class UserTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            [
                'role' => 1,
                'name' => 'admin',
                'email' => 'admin@hosting.com',
                'password' => Hash::make('admin@123'),
                'user_token' => Str::random(30)
            ],
        ]);
    }
}

class settingTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('setting')->insert([
            [
                'id' => 1,
                'limit' => '0',
            ],
        ]);
    }
}

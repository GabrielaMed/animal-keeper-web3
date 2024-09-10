<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_profile')->insert([
            [
                'id' => Str::uuid(),
                'name' => 'Anfitrião',
                'slug_name' => 'host',
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Hóspede',
                'slug_name' => 'guest',
            ],
        ]);
    }
}

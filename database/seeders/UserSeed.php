<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name'      => 'Superadmin',
                'email'     => 'admin@tenisindo.id',
                'password'  => Hash::make('password'),
                'client_id' => 0,
                'role_id'   => 1,
                'pin_key'   => 1234
            ],
        ];

        foreach ($data as $datum) {
            try {
                DB::table('users')->insert($datum);
            } catch (\Exception $e) {}
        }
    }
}

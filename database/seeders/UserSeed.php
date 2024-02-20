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
                'email'     => 'admin@tries.id',
                'password'  => Hash::make('password'),
                'client_id' => 0,
                'role_id'   => 1,
                'pin_key'   => 1234
            ],
            [
                'name'      => 'Administrator',
                'email'     => 'admin@client.id',
                'password'  => Hash::make('password'),
                'client_id' => 1,
                'role_id'   => 2,
                'pin_key'   => 1235
            ],
            [
                'name'      => 'Loket Pendaftaran',
                'email'     => 'admin@register.id',
                'password'  => Hash::make('password'),
                'client_id' => 1,
                'role_id'   => 3,
                'pin_key'   => 1236
            ],
            [
                'name'      => 'Loket Pemeriksaan Umum',
                'email'     => 'admin@general.id',
                'password'  => Hash::make('password'),
                'client_id' => 1,
                'role_id'   => 3,
                'pin_key'   => 1237
            ],
            [
                'name'      => 'Loket Pemeriksaan Lanjut',
                'email'     => 'admin@advance.id',
                'password'  => Hash::make('password'),
                'client_id' => 1,
                'role_id'   => 3,
                'pin_key'   => 1238
            ],
            [
                'name'      => 'Loket Farmasi',
                'email'     => 'admin@pharmacy.id',
                'password'  => Hash::make('password'),
                'client_id' => 1,
                'role_id'   => 3,
                'pin_key'   => 1239
            ],
            [
                'name'      => 'Loket Kasir',
                'email'     => 'admin@chashier.id',
                'password'  => Hash::make('password'),
                'client_id' => 1,
                'role_id'   => 3,
                'pin_key'   => 1240
            ],
            [
                'name'      => 'Kado Kita',
                'email'     => 'admin@kadokita.id',
                'password'  => Hash::make('password'),
                'client_id' => 2,
                'role_id'   => 2,
                'pin_key'   => 1234
            ],
        ];

        foreach ($data as $datum) {
            try {
                DB::table('users')->insert($datum);
            } catch (\Exception $e) {

            }
        }
    }
}

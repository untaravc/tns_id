<?php

namespace Database\Seeders;

use App\Models\Competition;
use App\Models\Player;
use Illuminate\Database\Seeder;

class DummySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $players = [
            ["full_name" => "Untara", "reg_id" => "0001", "status" => 1],
            ["full_name" => "Vivi", "reg_id" => "0001", "status" => 1],
        ];

        foreach ($players as $player) {
            $data = Player::whereFullName($player['full_name'])->first();
            if($data){
                $data->update($player);
            } else {
                Player::create($player);
            }
        }

        $competitions = [
            ["name" => "Armada", "status" => 1],
        ];

        foreach ($competitions as $competition) {
            $data = Competition::whereName($competition['name'])->first();
            if($data){
                $data->update($competition);
            } else {
                Competition::create($competition);
            }
        }
    }
}

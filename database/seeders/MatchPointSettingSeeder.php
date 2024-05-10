<?php

namespace Database\Seeders;

use App\Models\MatchPointSetting;
use Illuminate\Database\Seeder;

class MatchPointSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['competition_code' => 'J-1', 'match_type_code' => 'T', 'round_code' => 'W', 'point' => 150],
            ['competition_code' => 'J-1', 'match_type_code' => 'T', 'round_code' => 'F', 'point' => 90],
            ['competition_code' => 'J-1', 'match_type_code' => 'T', 'round_code' => 'SF', 'point' => 45],
            ['competition_code' => 'J-1', 'match_type_code' => 'T', 'round_code' => 'QF', 'point' => 25],
            ['competition_code' => 'J-1', 'match_type_code' => 'T', 'round_code' => 'R16', 'point' => 10],
            ['competition_code' => 'J-1', 'match_type_code' => 'T', 'round_code' => 'R32', 'point' => 5],

            ['competition_code' => 'J-2', 'match_type_code' => 'T', 'round_code' => 'W', 'point' => 100],
            ['competition_code' => 'J-2', 'match_type_code' => 'T', 'round_code' => 'F', 'point' => 60],
            ['competition_code' => 'J-2', 'match_type_code' => 'T', 'round_code' => 'SF', 'point' => 30],
            ['competition_code' => 'J-2', 'match_type_code' => 'T', 'round_code' => 'QF', 'point' => 17],
            ['competition_code' => 'J-2', 'match_type_code' => 'T', 'round_code' => 'R16', 'point' => 8],
            ['competition_code' => 'J-2', 'match_type_code' => 'T', 'round_code' => 'R32', 'point' => 4],

            ['competition_code' => 'J-3', 'match_type_code' => 'T', 'round_code' => 'W', 'point' => 60],
            ['competition_code' => 'J-3', 'match_type_code' => 'T', 'round_code' => 'F', 'point' => 36],
            ['competition_code' => 'J-3', 'match_type_code' => 'T', 'round_code' => 'SF', 'point' => 18],
            ['competition_code' => 'J-3', 'match_type_code' => 'T', 'round_code' => 'QF', 'point' => 10],
            ['competition_code' => 'J-3', 'match_type_code' => 'T', 'round_code' => 'R16', 'point' => 5],
            ['competition_code' => 'J-3', 'match_type_code' => 'T', 'round_code' => 'R32', 'point' => 3],

            ['competition_code' => 'J-4', 'match_type_code' => 'T', 'round_code' => 'W', 'point' => 40],
            ['competition_code' => 'J-4', 'match_type_code' => 'T', 'round_code' => 'F', 'point' => 24],
            ['competition_code' => 'J-4', 'match_type_code' => 'T', 'round_code' => 'SF', 'point' => 12],
            ['competition_code' => 'J-4', 'match_type_code' => 'T', 'round_code' => 'QF', 'point' => 7],
            ['competition_code' => 'J-4', 'match_type_code' => 'T', 'round_code' => 'R16', 'point' => 3],
            ['competition_code' => 'J-4', 'match_type_code' => 'T', 'round_code' => 'R32', 'point' => 2],

            ['competition_code' => 'J-5', 'match_type_code' => 'T', 'round_code' => 'W', 'point' => 30],
            ['competition_code' => 'J-5', 'match_type_code' => 'T', 'round_code' => 'F', 'point' => 18],
            ['competition_code' => 'J-5', 'match_type_code' => 'T', 'round_code' => 'SF', 'point' => 9],
            ['competition_code' => 'J-5', 'match_type_code' => 'T', 'round_code' => 'QF', 'point' => 5],
            ['competition_code' => 'J-5', 'match_type_code' => 'T', 'round_code' => 'R16', 'point' => 2],
            ['competition_code' => 'J-5', 'match_type_code' => 'T', 'round_code' => 'R32', 'point' => 1],

            ['competition_code' => 'J-6', 'match_type_code' => 'T', 'round_code' => 'W', 'point' => 20],
            ['competition_code' => 'J-6', 'match_type_code' => 'T', 'round_code' => 'F', 'point' => 12],
            ['competition_code' => 'J-6', 'match_type_code' => 'T', 'round_code' => 'SF', 'point' => 6],
            ['competition_code' => 'J-6', 'match_type_code' => 'T', 'round_code' => 'QF', 'point' => 3.3],
            ['competition_code' => 'J-6', 'match_type_code' => 'T', 'round_code' => 'R16', 'point' => 1.7],

            ['competition_code' => 'J-7', 'match_type_code' => 'T', 'round_code' => 'W', 'point' => 15],
            ['competition_code' => 'J-7', 'match_type_code' => 'T', 'round_code' => 'F', 'point' => 9],
            ['competition_code' => 'J-7', 'match_type_code' => 'T', 'round_code' => 'SF', 'point' => 4.5],
            ['competition_code' => 'J-7', 'match_type_code' => 'T', 'round_code' => 'QF', 'point' => 2.5],
            ['competition_code' => 'J-7', 'match_type_code' => 'T', 'round_code' => 'R16', 'point' => 1.3],

            ['competition_code' => 'J-8', 'match_type_code' => 'T', 'round_code' => 'W', 'point' => 10],
            ['competition_code' => 'J-8', 'match_type_code' => 'T', 'round_code' => 'F', 'point' => 6],
            ['competition_code' => 'J-8', 'match_type_code' => 'T', 'round_code' => 'SF', 'point' => 3],
            ['competition_code' => 'J-8', 'match_type_code' => 'T', 'round_code' => 'QF', 'point' => 1.7],
            ['competition_code' => 'J-8', 'match_type_code' => 'T', 'round_code' => 'R16', 'point' => 0.8],

            ['competition_code' => 'J-9', 'match_type_code' => 'T', 'round_code' => 'W', 'point' => 5],
            ['competition_code' => 'J-9', 'match_type_code' => 'T', 'round_code' => 'F', 'point' => 3],
            ['competition_code' => 'J-9', 'match_type_code' => 'T', 'round_code' => 'SF', 'point' => 1.5],
            ['competition_code' => 'J-9', 'match_type_code' => 'T', 'round_code' => 'QF', 'point' => 0.8],

            ['competition_code' => 'J-1', 'match_type_code' => 'G', 'round_code' => 'W', 'point' => 125],
            ['competition_code' => 'J-1', 'match_type_code' => 'G', 'round_code' => 'F', 'point' => 65],
            ['competition_code' => 'J-1', 'match_type_code' => 'G', 'round_code' => 'SF', 'point' => 35],
            ['competition_code' => 'J-1', 'match_type_code' => 'G', 'round_code' => 'QF', 'point' => 20],
            ['competition_code' => 'J-1', 'match_type_code' => 'G', 'round_code' => 'R16', 'point' => 12],

            ['competition_code' => 'J-2', 'match_type_code' => 'G', 'round_code' => 'W', 'point' => 80],
            ['competition_code' => 'J-2', 'match_type_code' => 'G', 'round_code' => 'F', 'point' => 48],
            ['competition_code' => 'J-2', 'match_type_code' => 'G', 'round_code' => 'SF', 'point' => 25],
            ['competition_code' => 'J-2', 'match_type_code' => 'G', 'round_code' => 'QF', 'point' => 15],
            ['competition_code' => 'J-2', 'match_type_code' => 'G', 'round_code' => 'R16', 'point' => 9],

            ['competition_code' => 'J-3', 'match_type_code' => 'G', 'round_code' => 'W', 'point' => 50],
            ['competition_code' => 'J-3', 'match_type_code' => 'G', 'round_code' => 'F', 'point' => 30],
            ['competition_code' => 'J-3', 'match_type_code' => 'G', 'round_code' => 'SF', 'point' => 20],
            ['competition_code' => 'J-3', 'match_type_code' => 'G', 'round_code' => 'QF', 'point' => 12],
            ['competition_code' => 'J-3', 'match_type_code' => 'G', 'round_code' => 'R16', 'point' => 7],

            ['competition_code' => 'J-4', 'match_type_code' => 'G', 'round_code' => 'W', 'point' => 30],
            ['competition_code' => 'J-4', 'match_type_code' => 'G', 'round_code' => 'F', 'point' => 20],
            ['competition_code' => 'J-4', 'match_type_code' => 'G', 'round_code' => 'SF', 'point' => 12],
            ['competition_code' => 'J-4', 'match_type_code' => 'G', 'round_code' => 'QF', 'point' => 7],
            ['competition_code' => 'J-4', 'match_type_code' => 'G', 'round_code' => 'R16', 'point' => 4],

            ['competition_code' => 'J-4', 'match_type_code' => 'G', 'round_code' => 'W', 'point' => 20],
            ['competition_code' => 'J-4', 'match_type_code' => 'G', 'round_code' => 'F', 'point' => 12],
            ['competition_code' => 'J-4', 'match_type_code' => 'G', 'round_code' => 'SF', 'point' => 7],
            ['competition_code' => 'J-4', 'match_type_code' => 'G', 'round_code' => 'QF', 'point' => 4],
            ['competition_code' => 'J-4', 'match_type_code' => 'G', 'round_code' => 'R16', 'point' => 2],
        ];

        foreach ($data as $item) {
            $exist = MatchPointSetting::where('competition_code', $item['competition_code'])
                ->where('match_type_code', $item['match_type_code'])
                ->where('round_code', $item['round_code'])
                ->first();

            if ($exist) {
                $exist->update([
                    'point' => $item['point'],
                    'name' => $this->setName($item),
                ]);
            } else {
                $item['name'] = $this->setName($item);
                MatchPointSetting::create($item);
            }
        }
    }

    public function setName($item)
    {
        $first = $item['competition_code'];
        $second = '';
        $third = '';

        switch ($item['match_type_code']) {
            case 'G':
                $second = 'Ganda';
                break;
            case 'T':
                $second = 'Tunggal';
                break;
        }

        switch ($item['round_code']) {
            case 'W':
                $third = 'Winner';
                break;
            case 'F':
                $third = 'Runner Up';
                break;
            case 'SF':
                $third = 'Semi Final';
                break;
            case 'QF':
                $third = 'Queater Final';
                break;
            case 'R16':
                $third = 'Round 16';
                break;
            case 'R32':
                $third = 'Round 32';
                break;
        }

        return $first . ' ' . $second . ' ' . $third;
    }
}

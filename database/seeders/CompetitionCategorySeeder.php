<?php

namespace Database\Seeders;

use App\Models\CompetitionCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompetitionCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ["name" => "U10 Putra", "code" => "U10M", "status" => 1],
            ["name" => "U12 Putra", "code" => "U12M", "status" => 1],
            ["name" => "U14 Putra", "code" => "U14M", "status" => 1],
            ["name" => "U16 Putra", "code" => "U16M", "status" => 1],
            ["name" => "U18 Putra", "code" => "U18M", "status" => 1],
            ["name" => "PRO Putra", "code" => "PROM", "status" => 1],
        ];

        $active_ids = [];
        foreach ($data as $datum) {
            $cc = CompetitionCategory::whereCode($datum['code'])->first();
            if($cc){
                $cc->update($datum);
            } else {
                $cc = CompetitionCategory::create($datum);
            }
            $active_ids[] = $cc->id;
        }

        CompetitionCategory::whereNotIn('id', $active_ids)->delete();
    }
}

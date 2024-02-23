<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ["type" => "player", "name" => "U10 Putra", "code" => "U10M", "status" => 1],
            ["type" => "player", "name" => "U12 Putra", "code" => "U12M", "status" => 1],
            ["type" => "player", "name" => "U14 Putra", "code" => "U14M", "status" => 1],
            ["type" => "player", "name" => "U16 Putra", "code" => "U16M", "status" => 1],
            ["type" => "player", "name" => "U18 Putra", "code" => "U18M", "status" => 1],
            ["type" => "player", "name" => "PRO Putra", "code" => "PROM", "status" => 1],

            ["type" => "competition", "name" => "J-1", "code" => "J-1", "status" => 1],
            ["type" => "competition", "name" => "J-2", "code" => "J-2", "status" => 1],

            ["type" => "post", "name" => "News", "code" => "news", "status" => 1],
        ];

        $active_ids = [];
        foreach ($data as $datum) {
            $cc = Category::whereCode($datum['code'])->first();
            if ($cc) {
                $cc->update($datum);
            } else {
                $cc = Category::create($datum);
            }
            $active_ids[] = $cc->id;
        }

        Category::whereNotIn('id', $active_ids)->delete();
    }
}

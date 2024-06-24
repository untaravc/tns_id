<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['type' => "website", 'name' => "soc-instagram", 'value' => "https://instagram.com", 'title' => "Tenis Indo",'status'=>1],
            ['type' => "website", 'name' => "soc-youtube", 'value' => "https://youtube.com", 'title' => "Tenis Indo",'status'=>1],
            ['type' => "website", 'name' => "soc-twitter", 'value' => "https://x.com", 'title' => "Tenis Indo",'status'=>1],
            ['type' => "website", 'name' => "soc-facebook", 'value' => "https://facebook.com", 'title' => "Tenis Indo",'status'=>1],
            ['type' => "ads", 'name' => "ads_space_side_detail", 'value' => "https://tenisindo.com", 'title' => "/assets/images/ads_space_side_detail.png",'status'=>1],
            ['type' => "ads", 'name' => "ads_home_footer", 'value' => "https://tenisindo.com", 'title' => "/assets/images/8x1.png",'status'=>1],
        ];

        foreach ($data as $datum) {
            $setting = Setting::where('type', $datum['type'])
                ->where('name', $datum['name'])
                ->first();

            if ($setting) {
                $setting->update($datum);
            } else {
                Setting::create($datum);
            }
        }
    }
}

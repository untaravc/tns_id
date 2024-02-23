<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\MenuRole;
use Illuminate\Database\Seeder;

class MenuSeed extends Seeder
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
                'title'    => "Dashboard",
                'icon'     => "md-spacedashboard",
                'url'      => "/admin/dashboard",
                'children' => [],
                'type'     => "menu",
            ],
            [
                'title'    => "Poin Pemain",
                'icon'     => "md-scoreboard",
                'url'      => "/admin/points--",
                'type'     => "menu",
                'children' => [
                    [
                        'title' => "Tambah Baru",
                        'icon'  => "",
                        'url'   => "/admin/points/add",
                        'type'  => "submenu",
                    ],
                    [
                        'title' => "Data",
                        'icon'  => "",
                        'url'   => "/admin/points",
                        'type'  => "submenu",
                    ],
                    [
                        'title' => "Report",
                        'icon'  => "",
                        'url'   => "/admin/point-reports",
                        'type'  => "submenu",
                    ],
                ]
            ],
            [
                'title'    => "Pertandingan",
                'icon'     => "md-sports",
                'url'      => "/admin/matches--",
                'type'     => "menu",
                'children' => [
                    [
                        'title' => "Tambah Baru",
                        'icon'  => "",
                        'url'   => "/admin/matches/add",
                        'type'  => "submenu",
                    ],
                    [
                        'title' => "Data",
                        'icon'  => "",
                        'url'   => "/admin/matches",
                        'type'  => "submenu",
                    ],
                ]
            ],
            [
                'title'    => "Berita",
                'icon'     => "md-newspaper",
                'url'      => "/admin/posts--",
                'type'     => "menu",
                'children' => [
                    [
                        'title' => "Tambah Baru",
                        'icon'  => "",
                        'url'   => "/admin/posts/add",
                        'type'  => "submenu",
                    ],
                    [
                        'title' => "Data",
                        'icon'  => "",
                        'url'   => "/admin/posts",
                        'type'  => "submenu",
                    ],
                ]
            ],
            [
                'title'    => "Master Data",
                'icon'     => "",
                'url'      => "/admin/master-data--",
                'type'     => "title",
                'children' => []
            ],
            [
                'title'    => "Pemain",
                'icon'     => "md-emojipeople",
                'url'      => "/admin/players--",
                'type'     => "menu",
                'children' => [
                    [
                        'title' => "Tambah Baru",
                        'icon'  => "",
                        'url'   => "/admin/players/add",
                        'type'  => "submenu",
                    ],
                    [
                        'title' => "Data",
                        'icon'  => "",
                        'url'   => "/admin/players",
                        'type'  => "submenu",
                    ],
                ]
            ],
            [
                'title'    => "Kategori Kompetisi",
                'icon'     => "md-category-outlined",
                'url'      => "/admin/competition-categories--",
                'type'     => "menu",
                'children' => [
                    [
                        'title' => "Tambah Baru",
                        'icon'  => "",
                        'url'   => "/admin/competition-categories/add",
                        'type'  => "submenu",
                    ],
                    [
                        'title' => "Data",
                        'icon'  => "",
                        'url'   => "/admin/competition-categories",
                        'type'  => "submenu",
                    ],
                ]
            ],
            [
                'title'    => "Kompetisi",
                'icon'     => "md-tour",
                'url'      => "/admin/competitions--",
                'type'     => "menu",
                'children' => [
                    [
                        'title' => "Tambah Baru",
                        'icon'  => "",
                        'url'   => "/admin/competitions/add",
                        'type'  => "submenu",
                    ],
                    [
                        'title' => "Data",
                        'icon'  => "",
                        'url'   => "/admin/competitions",
                        'type'  => "submenu",
                    ],
                ]
            ],
            [
                'title'    => "Kategori Berita",
                'icon'     => "md-tablerows",
                'url'      => "/admin/post-categories--",
                'type'     => "menu",
                'children' => [
                    [
                        'title' => "Tambah Baru",
                        'icon'  => "",
                        'url'   => "/admin/post-categories/add",
                        'type'  => "submenu",
                    ],
                    [
                        'title' => "Data",
                        'icon'  => "",
                        'url'   => "/admin/post-categories",
                        'type'  => "submenu",
                    ],
                ]
            ],
            [
                'title'    => "Admin",
                'icon'     => "md-verifieduser",
                'url'      => "/admin/users--",
                'type'     => "menu",
                'children' => [
                    [
                        'title' => "Tambah Baru",
                        'icon'  => "",
                        'url'   => "/admin/users/add",
                        'type'  => "submenu",
                    ],
                    [
                        'title' => "Data",
                        'icon'  => "",
                        'url'   => "/admin/users",
                        'type'  => "submenu",
                    ],
                ]
            ],
            [
                'title'    => "Role",
                'icon'     => "md-altroute",
                'url'      => "/admin/roles--",
                'type'     => "menu",
                'children' => [
                    [
                        'title' => "Tambah Baru",
                        'icon'  => "",
                        'url'   => "/admin/roles/add",
                        'type'  => "submenu",
                    ],
                    [
                        'title' => "Data",
                        'icon'  => "",
                        'url'   => "/admin/roles",
                        'type'  => "submenu",
                    ],
                ]
            ],
            [
                'title'    => "Menu",
                'icon'     => "md-menuopen",
                'url'      => "/admin/menus--",
                'type'     => "menu",
                'children' => [
                    [
                        'title' => "Tambah Baru",
                        'icon'  => "",
                        'url'   => "/admin/menus/add",
                        'type'  => "submenu",
                    ],
                    [
                        'title' => "Data",
                        'icon'  => "",
                        'url'   => "/admin/menus",
                        'type'  => "submenu",
                    ],
                    [
                        'title' => "Menu Role",
                        'icon'  => "",
                        'url'   => "/admin/menu-role",
                        'type'  => "submenu",
                    ],
                ]
            ]
        ];

        foreach ($data as $key => $datum) {
            $menu_created = Menu::whereUrl($datum['url'])->first();
            if (!$menu_created) {
                $menu_created = Menu::create([
                    "order" => $key + 1,
                    "title" => $datum['title'],
                    "icon"  => $datum['icon'],
                    "url"   => $datum['url'],
                    "type"  => $datum['type'],
                ]);
            } else {
                $menu_created->update([
                    "order" => $key + 1,
                    "title" => $datum['title'],
                    "icon"  => $datum['icon'],
                    "url"   => $datum['url'],
                    "type"  => $datum['type'],
                ]);
            }

            if (count($datum['children']) > 0) {
                foreach ($datum['children'] as $cld => $child) {
                    $child_created = Menu::whereUrl($child['url'])->first();
                    if (!$child_created) {
                        Menu::create([
                            "order"     => $cld + 1,
                            "title"     => $child['title'],
                            "icon"      => $child['icon'],
                            "url"       => $child['url'],
                            "type"      => $child['type'],
                            "parent_id" => $menu_created['id'],
                        ]);
                    } else {
                        $child_created->update([
                            "order"     => $cld + 1,
                            "title"     => $child['title'],
                            "icon"      => $child['icon'],
                            "url"       => $child['url'],
                            "type"      => $child['type'],
                            "parent_id" => $menu_created['id'],
                        ]);
                    }
                }
            }
        }

        $menus = Menu::get();
        foreach ($menus as $mn) {
            $menu_role = MenuRole::whereMenuId($mn['id'])->whereRoleId(1)->first();
            if (!$menu_role) {
                MenuRole::create([
                    'menu_id' => $mn['id'],
                    'role_id' => 1,
                ]);
            }
        }
    }
}

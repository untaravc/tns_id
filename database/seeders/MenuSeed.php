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
                'icon'     => "bi-columns-gap",
                'url'      => "/admin/dashboard",
                'children' => [],
                'type'     => "menu",
            ],
            [
                'title'    => "Poin Pemain",
                'icon'     => "bi-cursor",
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
                'icon'     => "bi-vector-pen",
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
                'icon'     => "bi-newspaper",
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
                'icon'     => "bi-people",
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
                'title'    => "Kategori",
                'icon'     => "bi-archive",
                'url'      => "/admin/categories--",
                'type'     => "menu",
                'children' => [
                    [
                        'title' => "Tambah Baru",
                        'icon'  => "",
                        'url'   => "/admin/categories/add",
                        'type'  => "submenu",
                    ],
                    [
                        'title' => "Data",
                        'icon'  => "",
                        'url'   => "/admin/categories",
                        'type'  => "submenu",
                    ],
                ]
            ],
            [
                'title'    => "Kompetisi",
                'icon'     => "bi-bookmark-star",
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
                'title'    => "Admin",
                'icon'     => "bi-shield-check",
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
                'icon'     => "bi-bezier2",
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
                'title'    => "Settings",
                'icon'     => "bi-gear",
                'url'      => "/admin/settings--",
                'type'     => "menu",
                'children' => [
                    [
                        'title' => "Tambah Baru",
                        'icon'  => "",
                        'url'   => "/admin/settings/add",
                        'type'  => "submenu",
                    ],
                    [
                        'title' => "Data",
                        'icon'  => "",
                        'url'   => "/admin/settings",
                        'type'  => "submenu",
                    ],
                ]
            ],
            [
                'title'    => "Menu",
                'icon'     => "bi-menu-button-wide",
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

        $active_ids = [];
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
            $active_ids[] = $menu_created->id;

            if (count($datum['children']) > 0) {
                foreach ($datum['children'] as $cld => $child) {
                    $child_created = Menu::whereUrl($child['url'])->first();
                    if (!$child_created) {
                        $child_created = Menu::create([
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
                    $active_ids[] = $child_created->id;
                }
            }
        }

        Menu::whereNotIn('id', $active_ids)->delete();

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

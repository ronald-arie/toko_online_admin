<?php
namespace App\Helpers;

class MenuHelper {

    public static function generateMenu() {
        $menus = config('menu.menu');
        $current_url = str_replace(url('/') . '/', '', url()->current());


        foreach ($menus as $key_menu => $menu) {
            if (!isset($menu['submenu'])) {
                continue;
            }
            foreach ($menu['submenu'] as $key_submenu => $submenu) {
                $menus[$key_menu]['url'] = '#';
                $active = [];
                $active_prefix = [];
                foreach ($submenu['active'] as $active_submenu) {
                    if (substr($active_submenu, -1) == '*') {
                        $active_submenu = str_replace('*', '', $active_submenu);
                        if ($active_submenu == substr($current_url, 0, strlen($active_submenu))) {
                            $menus[$key_menu]['menu-active'] = 'active';
                            $menus[$key_menu]['submenu'][$key_submenu]['menu-active'] = 'active';
                            $menus[$key_menu]['menu-open'] = 'menu-open';
                        }
                    } else {
                        if ($active_submenu == $current_url) {
                            $menus[$key_menu]['menu-active'] = 'active';
                            $menus[$key_menu]['submenu'][$key_submenu]['menu-active'] = 'active';
                            $menus[$key_menu]['menu-open'] = 'menu-open';
                        }
                    }
                }
            }
        }
        return $menus;
    }

}

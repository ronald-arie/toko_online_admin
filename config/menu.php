<?php

return [
    'menu' => [
        // 'USER ADMINISTRATION',
        [
            'text' => 'Home',
            'url' => "home",
            'active' => ['home'],
            'icon' => 'home',
        ],
        [
            'text' => 'Administration',
            'active' => [
                'user', 'user/*',
                'role', 'role/*',
            ],
            'icon' => 'user',
            'can' => ['user.view', 'role.view'],
            'submenu' => [
                [
                    'text' => 'User List',
                    'url' => 'user',
                    'active' => ['user', 'user/*'],
                    'can' => 'user.view',
                ],
                [
                    'text' => 'User Role',
                    'url' => 'role',
                    'active' => ['role', 'role/*'],
                    'can' => 'role.view',
                ],
            ]
        ],
        [
            'text' => 'Log Out',
            'url' => "logout",
            'active' => ['logout'],
            'icon' => 'sign-out-alt',
        ],
    ],
    // 'access_type'=>[0,1],
    // menunjukkan tipe akses ini bisa diakses oleh siapa
    'access' => [
    ],
    'access_description' => [
        'read' => 'read',
        'create' => 'create',
        'update' => 'update',
        'delete' => 'delete'
    ],
];

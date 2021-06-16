<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Application Information
    |--------------------------------------------------------------------------
    |
    */
    'title' => env('APP_NAME', 'Adminetic'),
    'prefix' => 'Admine',
    'suffix' => 'tic',
    'logo' => '',
    'favicon' => 'adminetic/static/favicon.png',
    'description' => 'Laravel Adminetic Admin Panel Upgrade.',
    'admin_home' => '/admin/dashboard',

    /*
    |--------------------------------------------------------------------------
    | UI Configuration
    |--------------------------------------------------------------------------
    |
    */

    // Header
    'mega_menu' => false,
    'level_menu' => false,
    'language_drawer' => false,
    'search' => false,
    'notification' => false,
    'quick_menu' => false,
    'dark_light_toggle' => true,
    'fullscreen_expander' => true,
    'profile' => true,

    /*
    |--------------------------------------------------------------------------
    | Card Setting
    |--------------------------------------------------------------------------
    |
    */
    'card' => '',
    'card_header' => 'b-l-primary border-3',
    'card_action_enabled' => true,
    'card_class' => '',
    'card_body' => 'shadow-lg',
    'card_footer' => '',
    'card_footer_enabled' => false,

    /*
    |--------------------------------------------------------------------------
    | Notify Configuraion
    |--------------------------------------------------------------------------
    |
    */
    'notify_icon' => 'fa fa-bell-o',
    'notify_type' => 'theme',
    'notify_allow_dismiss' => true,
    'notify_delay' => 2000,
    'notify_showProgressbar' => true,
    'notify_timer' => 300,
    'notify_newest_on_top' => true,
    'notify_mouse_over' => true,
    'notify_spacing' => 1,
    'notify_animate_in' => 'animated fadeInDown',
    'notify_animate_out' => 'animated fadeOutUp',

    /*
    |--------------------------------------------------------------------------
    | Admin Dashboard Route Configurations
    |--------------------------------------------------------------------------
    |
    */
    'prefix' => 'admin',
    'middleware' => ['web', 'auth'],

    /*
    |--------------------------------------------------------------------------
    | OAuth Socialite Configuration
    |--------------------------------------------------------------------------
    |
    */
    'enable_socialite' => false,
    'github_socialite' => true,
    'facebook_socialite' => true,

    /*
    |--------------------------------------------------------------------------
    | Auth Configuration
    |--------------------------------------------------------------------------
    */
    'login_view' => 'adminetic::admin.auth.login',
    'register_view' => 'adminetic::admin.auth.register',

    'default_user_role' => 'user',
    'default_user_role_level' => 1,

    /*
    |--------------------------------------------------------------------------
    | Data Settings
    |--------------------------------------------------------------------------
    |
    */
    'caching' => true,
    'migrate_with_dummy' => false,

    // ASSETS DEPENDENCIES INJECTION
    'assets' => [
        [
            'name' => 'Daterange Picker',
            'active' => true,
            'files' => [
                [
                    'type' => 'css',
                    'active' => true,
                    'location' => 'adminetic/assets/css/vendors/daterange-picker.css',
                ],
                [
                    'type' => 'js',
                    'active' => true,
                    'location' => 'adminetic/assets/js/datepicker/daterange-picker/moment.min.js',
                ],
                [
                    'type' => 'js',
                    'active' => true,
                    'location' => 'adminetic/assets/js/datepicker/daterange-picker/daterangepicker.js',
                ],
            ],
        ],
        [
            'name' => 'Charts',
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'active' => true,
                    'location' => 'adminetic/assets/js/chart/apex-chart/apex-chart.js',
                ],
                [
                    'type' => 'js',
                    'active' => true,
                    'location' => 'adminetic/assets/js/datepicker/daterange-picker/daterangepicker.js',
                ],
            ],
        ],
        [
            'name' => 'Datatable',
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'active' => true,
                    'location' => 'adminetic/assets/js/datatable/datatable-extension/dataTables.select.min.js',
                ],
            ],
        ],
    ],

    // Plugin Adapters
    'adapters' => [],
];

<?php

return
[
    'paths' => [
        'migrations' => '%%PHINX_CONFIG_DIR%%/db/migrations',
        'seeds' => '%%PHINX_CONFIG_DIR%%/db/seeds'
    ],
    'environments' => [
        'default_migration_table' => 'migrations',
        'default_environment' => 'testing',
        'production' => [
            'adapter' => 'mysql',
            'host' => '127.0.0.1',
            'name' => 'production_slim_php_unit_project',
            'user' => 'root',
            'pass' => 'mysql',
            'port' => '3306',
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci'
        ],
        'development' => [
            'adapter' => 'mysql',
            'host' => '127.0.0.1',
            'name' => 'development_slim_php_unit_project',
            'user' => 'root',
            'pass' => 'mysql',
            'port' => '3306',
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci'
        ],
        'testing' => [
            'adapter' => 'mysql',
            'host' => '127.0.0.1',
            'name' => 'testing_slim_php_unit_project',
            'user' => 'root',
            'pass' => 'mysql',
            'port' => '3306',
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci'
        ]
    ],
    'version_order' => 'creation'
];

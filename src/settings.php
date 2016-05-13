<?php
return [
    'settings' => [
        'displayErrorDetails' => true, // set to false in production

        // Renderer settings
        'renderer' => [
            'template_path' => __DIR__ . '/../templates/',
        ],

        // Monolog settings
        'logger' => [
            'name' => 'slim-app',
            'path' => __DIR__ . '/../logs/app.log',
        ],

        // Database settings
        'database' => [
            'db_host' => 'localhost:3306',
            'db_name' => 'taller_db',
            'db_usr' => 'taller',
            'db_pass' => 'rellat',
        ],
    ],
];

<?php

    return [

        'database' => [

            'driver' => 'mysql',
            'host' => 'localhost',
            'dbname' => 'noc_db',
            'username' => 'root',
            'password' => ''

        ],

        'mail' => [

            'transport' => 'smtp',
            'encrption' => 'tls',
            'port' => '587',
            'host' => 'smtp.gmail.com',
            'username' => 'info.mixblack@gmail.com',
            'password' => 'MIX@780;',
            'from' => 'no-reply@info.mixblack@gmail.com',
            'sender_name' => 'AAI | NOC Portal'

        ]

    ];

?>
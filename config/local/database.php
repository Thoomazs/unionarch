<?php

    return [

        /*
        |--------------------------------------------------------------------------
        | Database Connections
        |--------------------------------------------------------------------------
        |
        | Here are each of the database connections setup for your application.
        | Of course, examples of configuring each database platform that is
        | supported by Laravel is shown below to make development simple.
        |
        |
        | All database work in Laravel is done through the PHP PDO facilities
        | so make sure you have the driver for your particular database of
        | choice installed on your machine before you begin development.
        |
        */

        'connections' => [

            'mysql' => array( 'driver'      => 'mysql',
                              'host'        => 'localhost',
                              'database'    => 'laravel5',
                              'username'    => 'root',
                              'password'    => 'root',
                              'charset'     => 'utf8',
                              'collation'   => 'utf8_czech_ci',
                              'unix_socket' => '/Applications/MAMP/tmp/mysql/mysql.sock',
                              'prefix'      => '', ),
            'pgsql' => [ 'driver'   => 'pgsql',
                         'host'     => 'localhost',
                         'database' => 'homestead',
                         'username' => 'homestead',
                         'password' => 'secret',
                         'charset'  => 'utf8',
                         'prefix'   => '',
                         'schema'   => 'public', ],

        ],

    ];

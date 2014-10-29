<?php

    use Illuminate\Database\Seeder;

    class UsersTableSeeder extends Seeder
    {

        public function run()
        {

            // users

            DB::table( 'users' )->delete();

            $users = [ [ 'firstname'  => 'Tomáš',
                         'lastname'   => 'Novotný',
                         'slug'       => 'tomas-novotny',
                         'email'      => 'novotny@cynet.cz',
                         'password'   => bcrypt( 'heslo' ),
                         'created_at' => new DateTime,
                         'updated_at' => new DateTime ],
                       [ 'firstname'  => '',
                         'lastname'   => '',
                         'slug'       => 'test',
                         'email'      => 'test@cynet.cz',
                         'password'   => bcrypt( 'heslo' ),
                         'created_at' => new DateTime,
                         'updated_at' => new DateTime ] ];

            DB::table( 'users' )->insert( $users );


        }

    }

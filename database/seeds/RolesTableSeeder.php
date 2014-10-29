<?php

    use Illuminate\Database\Seeder;

    class RolesTableSeeder extends Seeder
    {

        public function run()
        {


            // roles

            DB::table( 'roles' )->delete();

            $roles = [ [ 'name'       => 'Admin',
                         'created_at' => new DateTime,
                         'updated_at' => new DateTime ] ];

            DB::table( 'roles' )->insert( $roles );

            // assign roles

            DB::table( 'assigned_roles' )->delete();

            $roles = [ [ 'user_id' => 1,
                         'role_id' => 1 ] ];

            DB::table( 'assigned_roles' )->insert( $roles );

        }

    }

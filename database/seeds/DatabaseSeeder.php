<?php

    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Seeder;

    class DatabaseSeeder extends Seeder
    {

        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run()
        {
            Model::unguard();

            DB::statement( 'SET FOREIGN_KEY_CHECKS=0;' );

            $this->call( 'UsersTableSeeder' );
            $this->call( 'RolesTableSeeder' );
            $this->call( 'LogsTableSeeder' );

            DB::statement( 'SET FOREIGN_KEY_CHECKS=1;' );
        }

    }

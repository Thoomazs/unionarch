<?php

    use Illuminate\Database\Seeder;

    class LogsTableSeeder extends Seeder
    {

        public function run()
        {
            DB::table( 'log' )->delete();


            $logs = [ [ 'level'      => 'info',
                        'user_id'    => 1,
                        'message'    => 'DB SEED',
                        'ip'         => '0.0.0.0',
                        'created_at' => new DateTime,
                        'updated_at' => new DateTime ] ];

            DB::table( 'log' )->insert( $logs );
        }

    }

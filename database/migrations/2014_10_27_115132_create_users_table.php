<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;

    class CreateUsersTable extends Migration
    {

        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::create( 'users', function ( Blueprint $table )
            {
                $table->increments( 'id' )->unsigned();

                $table->string( 'email' )->unique();

                $table->string( 'firstname' );
                $table->string( 'lastname' );
                $table->string( 'slug' );
                $table->string( 'phone' );
                $table->integer( 'address_id' )->unsigned()->nullable();

                $table->string( 'password', 60 );


                $table->rememberToken();
                $table->timestamps();

                $table->foreign( 'address_id' )->references( 'id' )->on( 'addresses' )->onUpdate( 'cascade' )->onDelete( 'set null' );
            } );
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down()
        {
            Schema::table( 'users', function ( Blueprint $table )
            {
                $table->dropForeign( 'users_address_id_foreign' );
            } );

            Schema::drop( 'users' );
        }

    }

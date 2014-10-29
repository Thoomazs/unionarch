<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create( 'addresses', function ( Blueprint $table )
        {
            $table->increments( 'id' )->unsigned();

            $table->string( 'street' );
            $table->string( 'city' );
            $table->string( 'postcode' );
            $table->string( 'state' );

            $table->timestamps();
        } );
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('addresses');
	}

}

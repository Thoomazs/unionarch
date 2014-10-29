<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCartTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cart', function(Blueprint $table)
		{
			$table->integer('order_id')->unsigned();
			$table->integer('product_id')->unsigned();
			$table->decimal('price');
			$table->integer('quantity')->unsigned();
			$table->timestamps();

            $table->foreign( 'order_id' )->references( 'id' )->on( 'orders' )->onUpdate( 'cascade' )->onDelete( 'cascade' );
            $table->foreign( 'product_id' )->references( 'id' )->on( 'products' )->onUpdate( 'cascade' )->onDelete( 'cascade' );

        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::table( 'cart', function ( Blueprint $table )
        {
            $table->dropForeign( 'cart_order_id_foreign' );
            $table->dropForeign( 'cart_product_id_foreign' );
        } );

		Schema::drop('cart');
	}

}

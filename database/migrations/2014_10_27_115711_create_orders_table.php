<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('orders', function(Blueprint $table)
        {
            $table->increments('id')->unsigned();

            $table->integer('shipping_id')->unsigned()->nullable();
            $table->integer('payment_id')->unsigned()->nullable();
            $table->integer('shipping_address_id')->unsigned()->nullable();
            $table->integer('delivery_address_id')->unsigned()->nullable();
            $table->integer('status_id')->unsigned()->nullable();

            $table->integer('user_id')->unsigned()->nullable();
            $table->string('name');
            $table->string('email');
            $table->string('phone');

            $table->timestamps();
            $table->timestamp('completed_at');


            $table->foreign( 'user_id' )->references( 'id' )->on( 'users' )->onUpdate( 'cascade' )->onDelete( 'set null' );
            $table->foreign( 'shipping_id' )->references( 'id' )->on( 'shippings' )->onUpdate( 'cascade' )->onDelete( 'restrict' );
            $table->foreign( 'payment_id' )->references( 'id' )->on( 'payments' )->onUpdate( 'cascade' )->onDelete( 'restrict' );
            $table->foreign( 'shipping_address_id' )->references( 'id' )->on( 'addresses' )->onUpdate( 'cascade' )->onDelete( 'restrict' );
            $table->foreign( 'delivery_address_id' )->references( 'id' )->on( 'addresses' )->onUpdate( 'cascade' )->onDelete( 'restrict' );
            $table->foreign( 'status_id' )->references( 'id' )->on( 'statuses' )->onUpdate( 'cascade' )->onDelete( 'restrict' );
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::table( 'orders', function ( Blueprint $table )
        {
            $table->dropForeign( 'orders_user_id_foreign' );
            $table->dropForeign( 'orders_shipping_id_foreign' );
            $table->dropForeign( 'orders_payment_id_foreign' );
            $table->dropForeign( 'orders_shipping_address_id_foreign' );
            $table->dropForeign( 'orders_delivery_address_id_foreign' );
            $table->dropForeign( 'orders_status_id_foreign' );
        } );

		Schema::drop('orders');
	}

}

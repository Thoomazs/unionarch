<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('categories', function(Blueprint $table)
        {
            $table->increments('id')->unsigned();
            $table->string('name');
            $table->text('slug');
            $table->text('desc');
            $table->integer('superior_id')->unsigned()->nullable();
            $table->timestamps();

        });

        Schema::table('categories', function(Blueprint $table)
        {
            $table->foreign( 'superior_id' )->references( 'id' )->on( 'categories' )->onUpdate( 'cascade' )->onDelete( 'set null' );
        });

        Schema::create( 'products_category', function ( $table )
        {
            $table->integer( 'product_id' )->unsigned();
            $table->integer( 'category_id' )->unsigned();

            $table->foreign( 'product_id' )->references( 'id' )->on( 'products' )->onUpdate( 'cascade' )->onDelete( 'cascade' );
            $table->foreign( 'category_id' )->references( 'id' )->on( 'categories' )->onUpdate( 'cascade' )->onDelete( 'cascade' );

        } );

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::table( 'products_category', function ( Blueprint $table )
        {
            $table->dropForeign( 'products_category_product_id_foreign' );
            $table->dropForeign( 'products_category_category_id_foreign' );
        } );


        Schema::drop( 'categories' );
        Schema::drop( 'products_category' );

	}

}

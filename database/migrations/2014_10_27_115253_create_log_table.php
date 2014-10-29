<?php

    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Database\Migrations\Migration;

    class CreateLogTable extends Migration {

        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::create('log', function(Blueprint $table)
            {
                $table->increments('id')->unsigned();
                $table->string('level',20);
                $table->integer('user_id')->unsigned()->nullable();
                $table->binary('message');
                $table->string('ip', 15);
                $table->timestamps();

                $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('set null');
            });
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down()
        {
            Schema::table('log', function (Blueprint $table) {
                $table->dropForeign('log_user_id_foreign');
            });

            Schema::drop('log');
        }

    }

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
                Schema::create('users', function (Blueprint $table) {
                        $table->increments('id');
                        $table->string('first_name');
                        $table->string('last_name');
                        $table->string('email')->unique();
                        $table->string('password', 60);
                        $table->date('birthday');
                        $table->string('phone_number', 20);
                        $table->enum('role', [0, 1])->default(0);
                        $table->rememberToken();
                        $table->timestamps();
                        $table->softDeletes();
                });
        }
    
        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down()
        {
                Schema::drop('users');
        }
}

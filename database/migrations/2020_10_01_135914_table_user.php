<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('user')) {
            Schema::create('user', function (Blueprint $table) {
                $table->Increments('user_id')->deafult(1);
                $table->string('fullname', 100);
                $table->string('email', 100);
                $table->text('password');
                $table->text('address');
                $table->string('photo', 100);
                $table->integer('id_card');
                $table->text('token');
                $table->enum('status', ['1', '0']);
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}

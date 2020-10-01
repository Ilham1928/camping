<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableMenuChild extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('menu_child')) {
            Schema::create('menu_child', function (Blueprint $table) {
                $table->Increments('menu_child_id');
                $table->string('menu_child_name', 100);
                $table->string('menu_child_url', 100);
                $table->integer('menu_parent_id')->unsigned();
                $table->enum('status', ['1', '0'])->comment('1=active, 2=inactive');
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

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableMenuParent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('menu_parent')) {
            Schema::create('menu_parent', function (Blueprint $table) {
                $table->Increments('menu_parent_id');
                $table->string('menu_parent_name', 100);
                $table->integer('menu_icon_id')->unsigned();
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

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableMenuIcon extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('menu_icon')) {
            Schema::create('menu_icon', function (Blueprint $table) {
                $table->Increments('menu_icon_id');
                $table->string('menu_icon_name', 100);
                $table->string('menu_icon_class', 100);
                $table->string('menu_icon_unicode', 100);
                $table->string('menu_icon_brand', 100);
                $table->enum('status', ['1', '0'])->comment('1=active, 2=inactive');
                $table->timestamps();
            });
        }
    }

    public function down()
    {
        //
    }
}

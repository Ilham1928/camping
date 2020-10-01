<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableItemMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('item_master')) {
            Schema::create('item_master', function (Blueprint $table) {
                $table->Increments('item_id')->deafult(1);
                $table->integer('category_id');
                $table->string('item_name', 150);
                $table->integer('item_price');
                $table->string('item_image', 100);
                $table->integer('item_stock');
                $table->text('item_description');
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

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('order')) {
            Schema::create('order', function (Blueprint $table) {
                $table->Increments('order_id')->deafult(1);
                $table->integer('user_id');
                $table->string('order_code', 150);
                $table->integer('total_price');
                $table->date('order_date');
                $table->enum('order_type', ['Barang', 'Pemandu']);
                $table->text('order_note');
                $table->boolean('is_cancel');
                $table->boolean('is_checkout');
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

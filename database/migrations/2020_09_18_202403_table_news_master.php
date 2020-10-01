<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableNewsMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('news_master')) {
            Schema::create('news_master', function (Blueprint $table) {
                $table->Increments('news_id')->deafult(1);
                $table->string('news_title', 100);
                $table->string('news_image');
                $table->longText('news_content');
                $table->enum('status', ['1', '0']);
                $table->integer('created_by');
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

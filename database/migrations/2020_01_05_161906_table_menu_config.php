<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableMenuConfig extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('cms_config')) {
            Schema::create('cms_config', function (Blueprint $table) {
                $table->Increments('cms_config_id')->deafult(1);
                $table->string('cms_config_brand', 100);
                $table->enum('cms_config_skin', ['default', 'blue', 'green', 'pink', 'red', 'sea', 'violet']);
                $table->timestamps();
            });

            DB::table('cms_config')->insert([
                'cms_config_brand'  => 'News',
                'cms_config_skin'   => 'default',
            ]);
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

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableAdminActivity extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('admin_activity')) {
            Schema::create('admin_activity', function (Blueprint $table) {
                $table->Increments('activity_id')->deafult(1);
                $table->string('activity_name', 100);
                $table->string('activity_by', 100);
                $table->text('activity_detail');
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

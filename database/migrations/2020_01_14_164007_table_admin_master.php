<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableAdminMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('admin_master')) {
            Schema::create('admin_master', function (Blueprint $table) {
                $table->Increments('admin_id')->deafult(1);
                $table->string('admin_name', 100);
                $table->string('admin_title', 100);
                $table->text('admin_description');
                $table->string('admin_email', 100);
                $table->string('admin_password', 200);
                $table->text('admin_token');
                $table->string('admin_photo', 100);
                $table->integer('role_id');
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

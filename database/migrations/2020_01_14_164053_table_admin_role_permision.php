<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableAdminRolePermision extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('admin_role_permission')) {
            Schema::create('admin_role_permission', function (Blueprint $table) {
                $table->bigIncrements('permission_id')->deafult(1);
                $table->integer('role_id');
                $table->integer('menu_id');
                $table->enum('menu_view', ['0', '1']);
                $table->enum('menu_add', ['0', '1']);
                $table->enum('menu_edit', ['0', '1']);
                $table->enum('menu_delete', ['0', '1']);
                $table->enum('menu_other', ['0', '1']);
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

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableGuide extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('guide')) {
            Schema::create('guide', function (Blueprint $table) {
                $table->Increments('guide_id')->deafult(1);
                $table->string('guide_name', 150);
                $table->integer('guide_experience');
                $table->date('guide_birthday');
                $table->enum('guide_gender', ['Laki-laki', 'Permepuan']);
                $table->string('guide_photo', 100);
                $table->boolean('guide_available');
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

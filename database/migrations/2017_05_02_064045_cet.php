<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Cet extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cet', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name')->comment('姓名');
            $table->string('number')->comment('准考证号');
            $table->string('context')->nullable()->comment('成绩数据json');
            $table->string('from')->nullable()->comment('来源');
            $table->string('openid')->nullable()->comment('openid');
            $table->timestamps();
            $table->index(['name', 'number']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('cet');
    }
}

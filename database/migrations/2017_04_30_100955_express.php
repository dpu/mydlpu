<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Express extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('express', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('openid')->comment('openid');
            $table->string('nu')->index()->comment('快件单号');
            $table->tinyInteger('state')->comment('快件当前状态码');
            $table->string('context')->nullable()->comment('快件最近状态');
            $table->timestamp('time')->nullable()->comment('快件最近状态时间');
            $table->string('com')->nullable()->comment('快件运输公司');
            $table->string('message')->nullable()->comment('快件查询结果反馈信息');
            $table->string('note')->nullable()->comment('备注');
            $table->string('remark')->nullable()->comment('Notice模板消息remark');
            $table->string('url')->nullable()->comment('kuaidi100的结果页链接');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('express');
    }
}

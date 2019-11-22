<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSignGithubToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('sign')->default('')->comment('签名');
            $table->string('github')->default('')->comment('github主页');
            $table->string('wechat')->default('')->comment('微信');
            $table->string('weibo')->default('')->comment('微博');
            $table->string('qq')->default('')->comment('qq');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['sign', 'github', 'wechat', 'qq', 'weibo']);
        });
    }
}

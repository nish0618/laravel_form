<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoginHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('login_histories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('admin_id')->comment('管理者ID');
            $table->text('user_agent')->comment('ログイン成功者使用機種');
            $table->string('ip_adress')->comment('ログイン成功者IPアドレス');
            $table->timestamp('login_time')->nullable()->comment('最終ログイン日時');
            $table->timestamps();

            $table->foreign('admin_id')
                ->references('id')
                ->on('admins')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('login_histories');
    }
}

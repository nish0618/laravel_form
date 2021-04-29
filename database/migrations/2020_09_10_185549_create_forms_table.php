<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     * last_name：苗字　first_name：名
     */
    public function up()
    {
        Schema::create('forms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('gender')->comment('性別 1:男性 2:女性');
            $table->integer('age')->comment('年齢 1:10代以下 2:20代 3:30代 4:40代 5:50代 6:60代 7:70代 8:80代以上');
            $table->string('zip')->comment('郵便番号');
            $table->string('prefecture')->comment('都道府県');
            $table->string('city', 255)->comment('市区町村');
            $table->string('email', 255)->comment('メールアドレス');
            $table->string('unique_url')->unique()->comment('ユニークURL');
            $table->integer('coupon_flag')->default(0)->comment('クーポン使用フラグ 0:未使用 1:使用済');
            $table->text('user_agent')->comment('応募者使用機種');
            $table->string('ip_adress')->comment('応募者IPアドレス');
            $table->timestamps();
            $table->softDeletes();
            $table->text('post');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('forms');
    }
}

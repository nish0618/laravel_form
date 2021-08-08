<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionnairesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questionnaires', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('form_id')->comment('フォームID');
            $table->integer('key')->comment('アンケート質問項目 1:好きなプログラミング言語を教えて下さい。（複数選択可）');
            $table->integer('value')->nullable()->comment('ユーザーアンケート回答内容');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('form_id')
                ->references('id')
                ->on('forms')
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
        Schema::dropIfExists('questionnaires');
    }
}

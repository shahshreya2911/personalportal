<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApiTokensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_question_anwser', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('category_id')->nullable();
			$table->integer('question_id')->nullable();
			$table->integer('answer_id')->nullable();
			$table->string('status')->nullable();
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
        Schema::dropIfExists('user_question_anwser');
    }
}

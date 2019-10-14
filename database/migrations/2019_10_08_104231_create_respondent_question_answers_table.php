<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRespondentQuestionAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('respondent_question_answers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('respondent_id');
            $table->unsignedBigInteger('question_id');
            $table->unsignedBigInteger('question_choice_id');
            $table->string('others')->nullable();
            $table->timestamps();

            $table->foreign('respondent_id')->references('id')->on('respondents');
            $table->foreign('question_id')->references('id')->on('questions');
            $table->foreign('question_choice_id')->references('id')->on('question_choices');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('respondent_question_answers');
    }
}

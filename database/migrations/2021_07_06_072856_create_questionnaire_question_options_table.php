<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionnaireQuestionOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questionnaire_question_options', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('q_d_id'); // questionnaire details id
            $table->text('response');
            $table->boolean('is_correct')->default(false);
            $table->timestamps();

            $table->foreign('q_d_id')->references('id')->on('questionnaire_details')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('questionnaire_question_options');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionnaireDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questionnaire_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('q_id');
            $table->text('question');
            $table->timestamps();

            $table->foreign('q_id')->references('id')->on('questionnaire')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('questionnaire_details');
    }
}

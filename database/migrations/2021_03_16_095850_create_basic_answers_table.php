<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBasicAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('basic_answers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('surveyable_id');
            $table->string('surveyable_type');
            $table->foreignId('fillerId')->nullable();
            $table->string('fillerName')->nullable();
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
        Schema::dropIfExists('basic_answers');
    }
}

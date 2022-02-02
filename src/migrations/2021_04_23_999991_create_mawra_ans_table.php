<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMawraAnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fmt_mawra_ans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('question_id');
            $table->longText('answer');
            $table->tinyInteger('active')->default(1);
            $table->foreignId('media_id')->nullable();
            $table->tinyInteger('arrange')->default(0);
            $table->string('eng_word')->nullable();
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
        Schema::dropIfExists('fmt_mawra_ans');
    }
}

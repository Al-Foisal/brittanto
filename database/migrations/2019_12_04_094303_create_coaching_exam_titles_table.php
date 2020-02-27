<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoachingExamTitlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coaching_exam_titles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('exam_title',32);
            $table->string('exam_date',32);
            $table->string('start_time',32);


            //making foreign key
            
            $table->unsignedBigInteger('inst_identity')->nullable();
            $table->foreign('inst_identity')
                  ->references('FI')
                  ->on('users')
                  ->onDelete('cascade');
            //making foregn end
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
        Schema::dropIfExists('coaching_exam_titles');
    }
}

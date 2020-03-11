<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoachingMarksTable extends Migration
{
    /**
     * Run the migrations.
     *name,id,exam_title,date,subject,marks,class
     * @return void
     */
    public function up()
    {
        Schema::create('coaching_marks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('student_name',128);
            $table->unsignedBigInteger('student_id');
            $table->string('section',128);
            $table->string('exam_title',32);
            $table->string('subject',32);
            $table->unsignedInteger('mark');
            $table->unsignedInteger('class');
            $table->unsignedInteger('defined_mark');

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
        Schema::dropIfExists('coaching_marks');
    }
}

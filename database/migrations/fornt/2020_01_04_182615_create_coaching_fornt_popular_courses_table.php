<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoachingForntPopularCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coaching_fornt_popular_courses', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('course_title',98);
            $table->string('course_banar',32)->nullable();

            $table->string('course_label',32);
            $table->string('total_seat',10);
            $table->string('course_duration',15);
            $table->string('course_fee',15);

            $table->text('course_description');

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
        Schema::dropIfExists('coaching_fornt_popular_courses');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoachingDailyTeacherSalariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coaching_daily_teacher_salaries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name',128);
            $table->string('comment',255)->nullable();
            $table->unsignedInteger('bonus')->nullable();
            $table->unsignedInteger('class');
            $table->unsignedInteger('per_class');
            $table->unsignedInteger('total');
            $table->string('status',28)->default('pending');
            $table->unsignedBigInteger('teacher_id');

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
        Schema::dropIfExists('coaching_daily_teacher_salaries');
    }
}

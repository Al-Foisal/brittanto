<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoachingCountersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coaching_counters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('student_count')->default(0);
            $table->unsignedBigInteger('teacher_count')->default(0);
            $table->unsignedBigInteger('course_count')->default(0);
            $table->unsignedBigInteger('event_count')->default(0);
            $table->unsignedBigInteger('owner_count')->default(0);

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
        Schema::dropIfExists('coaching_counters');
    }
}

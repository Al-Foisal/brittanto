<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoachingForntEnrollTodaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coaching_fornt_enroll_todays', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('full_name',128);
            $table->string('email',128);
            $table->string('phone_number',32);
            $table->string('message',150);

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
        Schema::dropIfExists('coaching_fornt_enroll_todays');
    }
}

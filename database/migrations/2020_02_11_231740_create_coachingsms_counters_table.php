<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoachingsmsCountersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coachingsms_counters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('count_sent_sms');

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
        Schema::dropIfExists('coachingsms_counters');
    }
}

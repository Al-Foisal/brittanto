<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoachingEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coaching_employees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name',128);
            $table->string('role',32); //teacher or staff(dropdown)
            $table->string('study',128); //ssc hsc honurs (dropdown) 
            $table->string('thr_study_inst',128); //last or running study institution
            $table->text('address');
            $table->unsignedBigInteger('phone');
            $table->unsignedInteger('salary');
            $table->string('commitment');  //any contract(dropdown)
            $table->string('image',128)->nullable();


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
        Schema::dropIfExists('coaching_employees');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoachingStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coaching_students', function (Blueprint $table) {
            $table->bigIncrements('id');
            
            $table->string('name',128);
            $table->string('school_name',128)->nullable();  //running study institution name
            $table->unsignedBigInteger('std_id')->unique();
            $table->unsignedBigInteger('amd_class');
            $table->string('amd_type',32); //regular or special (dropdown)
            $table->unsignedInteger('class_roll');
            $table->unsignedInteger('tution_fee');
            $table->text('address');
            $table->string('guardian_name',128);
            $table->unsignedBigInteger('grd_phone');
            $table->unsignedBigInteger('std_phone')->nullable();
            $table->unsignedBigInteger('std_serial');
            $table->string('commitment',128)->nullable();
            $table->string('reference',128);
            $table->string('section',128);
            $table->string('image',128)->nullable();

            //making foreign key
            
            
            $table->unsignedBigInteger('inst_identity')->nullable();
            $table->foreign('inst_identity')
                  ->references('FI')
                  ->on('users')
                  ->onDelete('cascade');
            //making foregn end
            //
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
        Schema::dropIfExists('coaching_students');
    }
}

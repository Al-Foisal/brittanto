<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoachingForntEducationalSolutionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coaching_fornt_educational_solutions', function (Blueprint $table) {
            $table->bigIncrements('id');
            
            $table->string('solution_title',32);
            $table->string('description',98);

            //making foreign key
            
            $table->unsignedBigInteger('inst_identity')->nullable();
            $table->foreign('inst_identity')
                  ->references('FI')
                  ->on('users')
                  ->onDelete('cascade');
            //making foregn end
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coaching_fornt_educational_solutions');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoachingProceedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coaching_proceeds', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('first_input_title',128);
            $table->decimal('first_money', 10 , 2 );

            $table->string('second_input_title',128);
            $table->decimal('second_money', 10 , 2 );

            $table->string('third_input_title',128)->nullable();
            $table->decimal('third_money', 10 , 2 )->nullable();

            $table->string('fourth_input_title',128)->nullable();
            $table->decimal('fourth_money', 10 , 2 )->nullable();

            $table->string('fifth_input_title',128)->nullable();
            $table->decimal('fifth_money', 10 , 2 )->nullable();

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
        Schema::dropIfExists('coaching_proceeds');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoachingPaidReceiptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coaching_paid_receipts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name',128);
            $table->unsignedBigInteger('std_id');
            $table->unsignedInteger('amd_class');
            $table->string('section',128);
            $table->string('amd_type',32);
            $table->unsignedInteger('total_paid');
            $table->unsignedBigInteger('receipt_serial');
            $table->unsignedBigInteger('proceed_id');

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
        Schema::dropIfExists('coaching_paid_receipts');
    }
}

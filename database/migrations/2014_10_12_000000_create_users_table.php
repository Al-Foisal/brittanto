<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration 
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name',198);
            $table->unsignedBigInteger('FI')->unique();  //a fixed identity value
            $table->unsignedBigInteger('identity');
            $table->string('abbreviation',32); //short form uppercase
            $table->string('area',98);
            $table->text('address');
            $table->string('email',98)->unique();
            $table->string('password',98);
            $table->string('owner',98);
            $table->unsignedBigInteger('owner_phone');
            $table->unsignedBigInteger('inst_phone');
            $table->tinyInteger('active')->default(0);
            $table->string('type'); //types of institutions (dropdown)
            $table->unsignedInteger('service'); //one in multiple (dropdown)
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}

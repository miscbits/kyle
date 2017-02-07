<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDemographicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('demographics', function (Blueprint $table) {
            $table->increments('id');
			$table->string('first_name');
			$table->string('middle_name');
			$table->string('last_name');
			$table->string('email');
			$table->string('phone');
			$table->string('address');
			$table->string('twitter');
			$table->integer('ward');
			$table->string('group');
			$table->boolean('student');
			$table->string('notes');
			$table->integer('donations');

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
        Schema::dropIfExists('demographics');
    }
}

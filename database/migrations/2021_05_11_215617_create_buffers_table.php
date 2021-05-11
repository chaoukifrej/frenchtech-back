<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buffers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();

            $table->bigInteger('actor_id')->unsigned;
            $table->foreign('actor_id')
                ->references('id')
                ->on('actors');

            $table->string('logo');
            $table->string('name', 64);
            $table->string('adress', 64);
            $table->float('longitude')->nullable();
            $table->float('latitude')->nullable();
            $table->string('email', 64)->unique();
            $table->integer('phone', 20);
            $table->string('category', 64);
            $table->string('associations', 64)->nullable();
            $table->text('description');
            $table->string('facebook')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('twitter')->nullable();
            $table->string('activity_area', 64);
            $table->float('funds');
            $table->integer('employees_number');
            $table->integer('jobs_available_number');
            $table->integer('women_number');
            $table->float('revenues');
            $table->string('magic_link');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('buffers');
    }
}

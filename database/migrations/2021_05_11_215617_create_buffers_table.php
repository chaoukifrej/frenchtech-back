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
            $table->string('type_of_demand');
            $table->timestamps();
            $table->rememberToken();
            $table->string('api_token', 80)
                ->unique()
                ->nullable()
                ->default(null);


            $table->unsignedBigInteger('actor_id')->nullable();
            $table->foreign('actor_id')
                ->references('id')
                ->on('actors')
                ->onDelete('cascade')
                ->onUpdate('cascade');;

            $table->longText('logo');
            $table->string('name', 64);
            $table->string('adress', 64);
            $table->mediumInteger('postal_code')->unsigned();
            $table->string('city', 64);
            $table->string('longitude')->nullable();
            $table->string('latitude')->nullable();
            $table->string('email', 64)->unique();
            $table->string('phone', 20);
            $table->string('category', 64);
            $table->string('associations', 64)->nullable();
            $table->text('description');
            $table->string('facebook')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('twitter')->nullable();
            $table->string('website')->nullable();
            $table->string('activity_area', 64);
            $table->float('funds');
            $table->smallInteger('employees_number')->unsigned();
            $table->smallInteger('jobs_available_number')->unsigned();
            $table->smallInteger('women_number')->unsigned();
            $table->float('revenues');
            $table->string('magic_link')->nullable();
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

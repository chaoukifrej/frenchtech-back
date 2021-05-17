<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->rememberToken();
            $table->string('api_token', 80)
                ->unique()
                ->nullable()
                ->default(null);

            $table->longText('logo');
            $table->string('name', 64);
            $table->string('adress', 64);
            $table->mediumInteger('postal_code');
            $table->string('city', 64);
            $table->string('longitude', 15)->nullable();
            $table->string('latitude', 15)->nullable();
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
            $table->smallInteger('employees_number');
            $table->tinyInteger('jobs_available_number');
            $table->smallInteger('women_number');
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
        Schema::dropIfExists('actors');
    }
}

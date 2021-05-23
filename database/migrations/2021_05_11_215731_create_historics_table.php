<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoricsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historics', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();

            $table->integer('total_actors')->nullable();
            $table->float('total_funds')->nullable();
            $table->integer('total_jobs_available')->nullable();
            $table->integer('total_women_number')->nullable();
            $table->integer('total_employees_number')->nullable();
            $table->float('total_revenues')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('historics');
    }
}

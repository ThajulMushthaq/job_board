<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCandidatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidates', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('job')->nullable();
            $table->index('job');
            $table->foreign('job')->references('id')->on('jobs')->onDelete('cascade');
            $table->string('name')->default('');
            $table->string('email')->unique();
            $table->string('phone')->default('');
            $table->string('resume')->default('');
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
        Schema::dropIfExists('candidates');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_tasks', function (Blueprint $table) {
            $table->id();
            $table->string("subject");
            $table->text("description");
            $table->foreignId("main_task");
            $table->string("status");
            $table->dateTime("pending_date")->nullable();
            $table->dateTime("in_progress_date")->nullable();
            $table->dateTime("approve_date")->nullable();
            $table->dateTime("complete_date")->nullable();
            $table->boolean("revined")->default(false);
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
        Schema::dropIfExists('sub_tasks');
    }
}

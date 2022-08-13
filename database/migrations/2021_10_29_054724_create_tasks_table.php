<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->text("description");
            $table->foreignId("project_id");
            $table->foreignId("user_id");
            $table->foreignId("status")->default(1);
            $table->dateTime("pending_date")->nullable();
            $table->dateTime("in_progress_date")->nullable();
            $table->dateTime("approve_date")->nullable();
            $table->dateTime("complete_date")->nullable();
            $table->dateTime("revine_date")->nullable();
            $table->date("deadline");
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
        Schema::dropIfExists('tasks');
    }
}

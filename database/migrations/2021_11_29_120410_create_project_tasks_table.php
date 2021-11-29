<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_tasks', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('project_id');
            $table->char('title', 250);
            $table->text('description');
            $table->integer('status');
        });

        Schema::table('project_tasks', function (Blueprint $table) {
            $table->unsignedBigInteger('project_id')->change();
            $table->foreign('project_id')->references('id')->on('projects')
                ->onDelete('CASCADE')->onUpdate('CASCADE');
        });

        Schema::table('projects', function (Blueprint $table) {
            $table->integer('status');
        });
    }



    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project_tasks');
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
}

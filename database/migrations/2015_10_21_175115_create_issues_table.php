<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIssuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('issues', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('issue');
            $table->tinyInteger('status')->default('0');
            $table->string('summary');
            $table->text('details');
            $table->string('type');
            $table->timestamps();
            $table->timestamp('open_date');
            $table->timestamp('close_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('issues');
    }
}

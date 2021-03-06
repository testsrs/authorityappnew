<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_messages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('message_text');
            $table->string('link');
            $table->integer('group_id');
            $table->integer('user_id');
            $table->tinyInteger('status');
            $table->tinyInteger('group_type');
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
        Schema::drop('group_messages');
    }
}

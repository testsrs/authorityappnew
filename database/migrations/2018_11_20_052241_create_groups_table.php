<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('is_private');
            $table->integer('is_approved');
            $table->string('lock_code');
            $table->string('color');
            $table->tinyInteger('status');
            $table->tinyInteger('type');
            $table->string('image_url');
            $table->string('group_ids');
            $table->integer('showviews');
            $table->integer('created_by');
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
          Schema::drop('groups');
    }
}

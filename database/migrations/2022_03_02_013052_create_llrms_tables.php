<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLlrmsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_groups', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50);
            $table->string('description', 100)->nullable();
            $table->integer('level');
            $table->timestamps();
        });

        Schema::create('tb_office', function (Blueprint $table) {
            $table->increments('id');
            $table->string('officename', 50);
            $table->string('district', 30)->nullable();

            $table->timestamps();
        });

        Schema::create('tb_positions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50);
            $table->string('code', 30);
            $table->integer('group_id')->unsigned()->nullable();
            $table->foreign('group_id')->references('id')->on('tb_groups')->onUpdate('cascade')->onDelete('set null');
            $table->string('description', 100)->nullable();
            $table->timestamps();
        });

        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('group_id')->unsigned()->nullable();
            $table->foreign('group_id')->references('id')->on('tb_groups')->onUpdate('cascade')->onDelete('set null');
            $table->string('username', 30);
            $table->string('email', 30)->unique()->nullable();
            $table->string('google_id')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password', 64);
            $table->rememberToken();
            $table->string('first_name', 30);
            $table->string('last_name', 30);
            $table->integer('office_id')->unsigned()->nullable();
            $table->foreign('office_id')->references('id')->on('tb_office')->onUpdate('cascade')->onDelete('set null');
            $table->integer('position_id')->unsigned()->nullable();
            $table->foreign('position_id')->references('id')->on('tb_positions')->onUpdate('cascade')->onDelete('set null');
            $table->timestamps();
        });

        Schema::create('tb_learningresource', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('uploadedbyid')->unsigned()->nullable();
            $table->foreign('uploadedbyid')->references('id')->on('users')->onUpdate('cascade')->onDelete('set null');
            $table->integer('grade_level');
            $table->string('subject_name', 50);
            $table->string('filename', 50);
            $table->string('filetype', 30);
            $table->string('filesize', 20);
            $table->string('filedescription', 100)->nullable();
            $table->boolean('verified');
            $table->timestamps();
        });

        Schema::create('tb_downloadedfile', function (Blueprint $table) {
            $table->id();
            $table->integer('resource_id')->unsigned()->nullable();
            $table->foreign('resource_id')->references('id')->on('tb_learningresource')->onUpdate('cascade')->onDelete('set null');
            $table->integer('downloadedbyid')->unsigned()->nullable();
            $table->foreign('downloadedbyid')->references('id')->on('users')->onUpdate('cascade')->onDelete('set null');
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
        Schema::dropIfExists('users');
        Schema::dropIfExists('tb_groups');
        Schema::dropIfExists('tb_office');
        Schema::dropIfExists('tb_positions');
        Schema::dropIfExists('tb_learningresource');
        Schema::dropIfExists('tb_downloadedfile');

    }
}

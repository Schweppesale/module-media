<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMedia extends Migration
{
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('videos', function (Blueprint $table) {
            $table->dropForeign('videos_file_id_foreign');
        });

        Schema::table('video_clips', function (Blueprint $table) {
            $table->dropForeign('video_clips_video_id_foreign');
        });

        Schema::dropIfExists('files');
        Schema::dropIfExists('videos');
        Schema::dropIfExists('video_clips');
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->string('disk');
            $table->string('hash');
            $table->string('path');
            $table->string('size');
            $table->string('mime_type');
            $table->timestamps();
        });

        Schema::create('videos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->unsignedInteger('source_id');
            $table->unsignedInteger('file_id');
            $table->timestamps();

            $table->foreign('file_id')
                ->references('id')
                ->on('files')
                ->onDelete('cascade');
        });

        Schema::create('video_clips', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('video_id');
            $table->unsignedInteger('start_time');
            $table->unsignedInteger('end_time');
            $table->timestamps();

            $table->foreign('video_id')
                ->references('id')
                ->on('videos')
                ->onDelete('cascade');
        });
    }
}

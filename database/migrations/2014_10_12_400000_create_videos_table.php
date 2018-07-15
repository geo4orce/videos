<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideosTable extends Migration
{
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('path')->nullable();
            $table->string('duration')->nullable();
            $table->string('size')->nullable();
            $table->string('format')->nullable();
            $table->string('bitrate')->nullable();
            $table->unsignedInteger('location_id')->nullable()->onDelete('set null');
            $table->unsignedInteger('user_id')->nullable()->onDelete('set null');
            $table->timestamps();

            // one to many
            $table
                ->foreign('location_id')
                ->references('id')
                ->on('locations')
                ->onDelete('cascade');
            $table
                ->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });

        // many to many
        Schema::create('keyword_video', function (Blueprint $table) { // pivot table must be named alphabetically!
            $table->increments('id');
            $table->unsignedInteger('video_id');
            $table->unsignedInteger('keyword_id');

            $table->foreign('video_id')->references('id')->on('videos')->onDelete('cascade');
            $table->foreign('keyword_id')->references('id')->on('keywords')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('keyword_video'); // first drop pivots to avoid integrity problems
        Schema::dropIfExists('videos');
    }
}

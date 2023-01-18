<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('programs', function (Blueprint $table) {
            $table->id();
            $table->string('date');
            $table->string('time');
            $table->string('time_end');
            $table->string('title');
            $table->string('info')->nullable();
            $table->text('header')->nullable();
            $table->string('moderators')->nullable();
            $table->text('text')->nullable();
            $table->text('summary')->nullable();
            $table->string('video_id')->nullable();
            $table->string('files')->nullable();
            $table->string('preview')->nullable();
            $table->boolean('is_payed')->nullable();
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
        Schema::dropIfExists('programs');
    }
};

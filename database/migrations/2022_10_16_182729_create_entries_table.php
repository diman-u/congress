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
        Schema::create('entries', function (Blueprint $table) {
            $table->id();

            $table->integer('status')->default(0);
            $table->string('title');
            $table->text('full_title');
            $table->text('description');
            $table->text('body');
            $table->text('organization')->nullable();
            $table->string('link')->nullable();
            $table->integer('place')->default(0)->unsigned();

            $table->integer('user_id')->nullable();
            $table->integer('nomination_id');
            $table->integer('event_id')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('entries');
    }
};

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
        Schema::create('entry_members', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->integer('entry_id');
            $table->string('name');
            $table->string('position');
            $table->string('city');
            $table->integer('sort')->default(100);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('entry_members');
    }
};

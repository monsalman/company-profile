<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('profilekami', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description_1');
            $table->text('description_2');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('profilekami');
    }
};

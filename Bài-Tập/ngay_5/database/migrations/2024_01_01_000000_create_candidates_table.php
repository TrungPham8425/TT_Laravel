<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('candidates', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->date('birthday');
            $table->string('avatar_path')->nullable();
            $table->string('cv_path');
            $table->text('bio')->nullable();
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('candidates');
    }
};

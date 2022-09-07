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
        Schema::create('estates', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('contact')->nullable();
            $table->string('phone')->nullable();
            $table->text('embed')->nullable();
            $table->string('mapurl')->nullable();
            $table->decimal('price', 11,2)->nullable();
            $table->string('description')->nullable();
            $table->string('image')->nullable();
            $table->decimal('latitude',8,7)->nullable();
            $table->decimal('longitude',8,7)->nullable();
            $table->string('country')->nullable();
            $table->string('region')->nullable();
            $table->string('constituency')->nullable();
            $table->string('county')->nullable();
            $table->string('district')->nullable();
            $table->string('postcode')->nullable();
            $table->boolean('status')->nullable();
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
        Schema::dropIfExists('estates');
    }
};

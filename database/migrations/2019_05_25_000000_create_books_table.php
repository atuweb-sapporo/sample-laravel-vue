<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('books', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 64);
            $table->string('subtitle', 64)->nullable();
            $table->string('author', 128)->nullable();
            $table->string('publisher', 32)->nullable();
            $table->string('release', 10)->nullable();
            $table->string('summary', 512);
            $table->string('isbn_10', 16)->index()->nullable();
            $table->string('isbn_13', 16)->index()->nullable();
            $table->string('image_link', 256)->nullable();
            $table->string('language', 8);
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
        Schema::dropIfExists('books');
    }
}

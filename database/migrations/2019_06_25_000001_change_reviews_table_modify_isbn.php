<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeReviewsTableModifyIsbn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reviews', function (Blueprint $table) {
            $table->dropColumn('book_id');
            $table->string('isbn', 13)
                ->index()
                ->after('id')
                ->comment('ISBN10/13');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reviews', function (Blueprint $table) {
            $table->dropColumn('isbn');
            $table->integer('book_id')
                ->unsigned()
                ->default(0)
                ->after('id');
        });
    }
}

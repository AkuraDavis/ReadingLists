<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_lists', function (Blueprint $table) {
            $table->uuid('id');
            $table->primary('id');

            $table->integer('user_id');
            $table->string('name');
            $table->text('desc')->nullable();

            $table->boolean('public')->default(true);

            $table->timestamps();
        });

        Schema::create('book_list_books', function (Blueprint $table) {
            $table->increments('id');

            $table->uuid('book_list_id');
            $table->uuid('book_id');

            $table->integer('display_order');

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
        Schema::dropIfExists('book_lists');
        Schema::dropIfExists('book_list_books');
    }
}

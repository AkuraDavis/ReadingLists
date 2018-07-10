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
            $table->uuid('id');
            $table->primary('id');

            $table->string('title');
            $table->string('author')->default('');
            $table->string('isbn')->nullable();
            $table->string('thumbnail')->default('')->nullable();
            $table->date('publication_date')->default('1901-01-01');

            $table->integer('contributed_by')->nullable();
            $table->boolean('public')->default(false);

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

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_translations', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('locale')->index();

            $table->unsignedBigInteger('book_id')->index();
            $table->foreign('book_id')->references('id')->on('books')->onDelete('cascade');


            $table->string('title');
            $table->string('author');
            $table->longText('description');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('book_translations');
    }
}

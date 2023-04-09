<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('book_mark_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        \App\Models\BookMarkType::create([
            'name'=>"المفضلة",
        ]);
        \App\Models\BookMarkType::create([
            'name'=>"القرائة لاحقا",
        ]);
        \App\Models\BookMarkType::create([
            'name'=>"تمت قراءته",
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_mark_types');
    }
};

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
        Schema::create('berita', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->text('isi')->nullable();
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_kategory');
            $table->string('image')->nullable();
            $table->boolean('status')->default(false);
            $table->timestamps();
            $table->foreign('id_user')->references('id')->on('user')->onDelete('restrict');
            $table->foreign('id_kategory')->references('id')->on('kategori_berita')->onDelete('restrict');


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('berita');
    }
};

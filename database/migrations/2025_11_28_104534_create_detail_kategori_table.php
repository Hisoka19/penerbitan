<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('detail_kategori', function (Blueprint $table) {
            $table->uuid('buku_id');
            $table->uuid('kategori_id');
            $table->primary(['buku_id', 'kategori_id']);

            $table->foreign('buku_id')
                ->references('id')->on('buku')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('kategori_id')
                ->references('id')->on('kategori_buku')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_kategori');
    }
};

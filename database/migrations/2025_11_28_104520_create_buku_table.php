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
        Schema::create('buku', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id');
            $table->uuid('editor_id')->nullable();
            $table->uuid('bahasa_id')->nullable();

            $table->string('judul', 255);
            $table->string('slug')->unique();

            $table->string('kelompok_pembaca', 20)->nullable();
            $table->string('jenis_pustaka', 100)->nullable();

            $table->string('cover_depan')->nullable();
            $table->string('cover_belakang')->nullable();

            $table->integer('halaman')->nullable();
            $table->string('edisi', 50)->nullable();
            $table->string('series', 100)->nullable();
            $table->integer('tahun_terbit')->nullable();

            $table->string('penerbit_buku')->nullable();
            $table->jsonb('penulis_buku')->nullable();
            $table->text('sinopsis_buku')->nullable();

            $table->string('no_isbn', 50)->unique()->nullable();
            $table->date('tanggal_terbit')->nullable();
            $table->string('link_publikasi')->nullable();

            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('editor_id')
                ->references('id')->on('users')
                ->onDelete('set null')
                ->onUpdate('cascade');

            $table->foreign('bahasa_id')
                ->references('id')->on('bahasa')
                ->onDelete('set null')
                ->onUpdate('cascade');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buku');
    }
};

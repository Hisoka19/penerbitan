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
        Schema::create('review', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('buku_id');
            $table->uuid('user_id');
            $table->integer('rating');
            $table->text('review')->nullable();
            $table->timestamp('created_at')->useCurrent();

            $table->unique(['buku_id', 'user_id']);

            $table->foreign('buku_id')
                ->references('id')->on('buku')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('review');
    }
};

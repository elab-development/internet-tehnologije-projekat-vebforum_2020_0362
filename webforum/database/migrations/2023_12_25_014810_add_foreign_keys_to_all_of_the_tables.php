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
        //DODAJEMO SPOLJNE KLJUCEVE TABELI THREADS
        Schema::table('threads', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->references('id')->on('users')->onDelete('set null');
        });

        //DODAJEMO SPOLJNE KLJUCEVE TABELI POSTS
        Schema::table('posts', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->references('id')->on('users')->onDelete('set null');
            $table->foreignId('thread_id')->nullable()->references('id')->on('threads')->onDelete('set null');
        });

        //DODAJEMO SPOLJNE KLJUCEVE TABELI COMMENTS
        Schema::table('comments', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->references('id')->on('users')->onDelete('set null');
            $table->foreignId('post_id')->nullable()->references('id')->on('posts')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //IZBACUJEMO SPOLJNE KLJUCEVE IZ TABELE THREADS
        Schema::table('threads', function (Blueprint $table) {
            $table->dropForeign('user_id');
        });

        //IZBACUJEMO SPOLJNE KLJUCEVE IZ TABELE POSTS
        Schema::table('posts', function (Blueprint $table) {
            $table->dropForeign('user_id');
            $table->dropForeign('thread_id');
        });

        //IZBACUJEMO SPOLJNE KLJUCEVE IZ TABELE COMMENTS
        Schema::table('comments', function (Blueprint $table) {
            $table->dropForeign('user_id');
            $table->dropForeign('post_id');
        });
    }
};

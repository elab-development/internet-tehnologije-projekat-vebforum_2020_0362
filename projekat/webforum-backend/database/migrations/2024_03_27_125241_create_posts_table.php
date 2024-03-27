<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->String("sjt_post");
            $table->integer("upvote")->default(0)->nullable();;

            $table->foreignId('categorie_id')->constrained()->onDelete('cascade');;
            $table->foreignId('utilisateur_id')->constrained()->onDelete('cascade');;
            $table->integer("downvote")->default(0)->nullable();;
            $table->date("date_post")->nullable();;

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
        Schema::dropIfExists('posts');
    }
};

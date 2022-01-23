<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblGenUserAvatarReactions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_gen_user_avatar_reactions', function (Blueprint $table) {
            $table->id('int_code');
            $table->unsignedBigInteger('fk_user_avatar_code');
            $table->foreign('fk_user_avatar_code')->references('int_code')->on('tbl_gen_user_avatars');
            $table->unsignedBigInteger('fk_user_code');
            $table->foreign('fk_user_code')->references('int_code')->on('tbl_gen_users');
            $table->unsignedBigInteger('fk_reaction_code');
            $table->foreign('fk_reaction_code')->references('int_code')->on('tbl_gen_type_of_reactions');
            $table->boolean('status')->default(true);
            $table->timestamps();
            $table->dateTime('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_gen_user_avatar_reactions');
    }
}

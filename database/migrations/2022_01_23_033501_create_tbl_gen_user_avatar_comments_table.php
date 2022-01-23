<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblGenUserAvatarCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_gen_user_avatar_comments', function (Blueprint $table) {
            $table->id('int_code');
            $table->unsignedBigInteger('fk_user_avatar_code');
            $table->foreign('fk_user_avatar_code')->references('int_code')->on('tbl_gen_user_avatars');
            $table->unsignedBigInteger('fk_user_code');
            $table->foreign('fk_user_code')->references('int_code')->on('tbl_gen_users');
            $table->text('vch_description');
            $table->integer('int_total_reactions')->nullable();
            $table->integer('int_total_responses')->nullable();
            $table->integer('int_parent')->nullable();
            $table->boolean('bool_can_delete')->default(true);
            $table->boolean('status')->default(true);
            $table->integer('deleted_by');
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
        Schema::dropIfExists('tbl_gen_user_avatar_comments');
    }
}

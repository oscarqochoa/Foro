<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblGenUserAvatarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_gen_user_avatars', function (Blueprint $table) {
            $table->id('int_code');
            $table->unsignedBigInteger('fk_user_code');
            $table->foreign('fk_user_code')->references('int_code')->on('tbl_gen_users');
            $table->string('vch_url');
            $table->string('vch_image_type', 30);
            $table->text('vch_description');
            $table->integer('int_total_reactions')->nullable();
            $table->integer('int_total_comments')->nullable();
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
        Schema::dropIfExists('tbl_gen_user_avatars');
    }
}

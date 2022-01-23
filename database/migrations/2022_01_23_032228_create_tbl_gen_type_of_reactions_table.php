<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblGenTypeOfReactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_gen_type_of_reactions', function (Blueprint $table) {
            $table->id('int_code');
            $table->string('vch_name')->nullable();
            $table->string('vch_image');
            $table->string('vch_image_type', 30)->nullable();
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
        Schema::dropIfExists('tbl_gen_type_of_reactions');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblGenUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_gen_users', function (Blueprint $table) {
            $table->id('int_code');
            $table->string('vch_first_name', 30);
            $table->string('vch_second_name', 30)->nullable();
            $table->string('vch_middle_name', 30);
            $table->string('vch_last_name', 30)->nullable();
            $table->string('vch_address')->nullable();
            $table->string('vch_phone_number', 20)->nullable();
            $table->string('vch_country', 100)->nullable();
            $table->string('vch_state', 100)->nullable();
            $table->enum('enum_gender', ['male', 'female', 'wg'])->nullable();
            $table->date('dte_dob')->nullable();
            $table->string('vch_email', 150);
            $table->string('vch_password');
            $table->dateTime('dtm_verified_at')->nullable();
            $table->boolean('bool_verified_account')->default(false);
            $table->boolean('bool_online')->default(false);
            $table->dateTime('dtm_last_connection')->nullable();
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
        Schema::dropIfExists('tbl_gen_users');
    }
}

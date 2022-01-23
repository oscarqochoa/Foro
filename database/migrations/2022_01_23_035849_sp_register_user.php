<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class SpRegisterUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $procedure = "CREATE procedure `sp_register_user`
            (
                in pVch_firstName varchar(30),
                in pVch_secondName varchar(30),
                in pVch_middleName varchar(30),
                in pVch_lastName varchar(30),
                in pVch_address varchar(200),
                in pVch_phoneNumber varchar(20),
                in pVch_country varchar(100),
                in pVch_state varchar(100),
                in pInt_gender int,
                in pDte_dob date,
                in pVch_email varchar(150),
                in pVch_password varchar(250)
            )
            begin

                insert into tbl_gen_users
                (
                    vch_first_name,
                    vch_second_name,
                    vch_middle_name,
                    vch_last_name,
                    vch_address,
                    vch_phone_number,
                    vch_country,
                    vch_state,
                    enum_gender,
                    dte_dob,
                    vch_email,
                    vch_password,
                    created_at
                )
                values
                (
                    pVch_firstName,
                    pVch_secondName,
                    pVch_middleName,
                    pVch_lastName,
                    pVch_address,
                    pVch_phoneNumber,
                    pVch_country,
                    pVch_state,
                    pInt_gender,
                    pDte_dob,
                    pVch_email,
                    pVch_password,
                    now()
                );

                select last_insert_id() as last_code;

            end;
        ";

        DB::unprepared("drop procedure if exists sp_register_user");
        DB::unprepared($procedure);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}

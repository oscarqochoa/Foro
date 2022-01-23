<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class SpUpdateUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $procedure = "CREATE procedure `sp_update_user`
            (
                in pInt_code int,
                in pVch_firstName varchar(30),
                in pVch_secondName varchar(30),
                in pVch_middleName varchar(30),
                in pVch_lastName varchar(30),
                in pVch_address varchar(200),
                in pVch_phoneNumber varchar(20),
                in pVch_country varchar(100),
                in pVch_state varchar(100),
                in pInt_gender int,
                in pDte_dob date
            )
            begin

                update tbl_gen_users
                    set
                        vch_first_name = pVch_firstName,
                        vch_second_name = pVch_secondName,
                        vch_middle_name = pVch_middleName,
                        vch_last_name = pVch_lastName,
                        vch_address = pVch_address,
                        vch_phone_number = pVch_phoneNumber,
                        vch_country = pVch_country,
                        vch_state = pVch_state,
                        enum_gender = pInt_gender,
                        dte_dob = pDte_dob
                    where int_code = pInt_code;

            end;
        ";

        DB::unprepared("drop procedure if exists sp_update_user");
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

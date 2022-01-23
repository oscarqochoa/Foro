<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class SpAuthenticateUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $procedure = "CREATE procedure `sp_authenticate_user`
            (
                in pVch_email varchar(150),
                in pVch_password varchar(200)
            )
            begin

                declare d_code int;
                declare d_verified_account boolean;

                select int_code, bool_verified_account
                into d_code, d_verified_account
                from tbl_gen_users
                where vch_email = pVch_email
                and vch_password = pVch_password;

                if(d_verified_account) then

                    insert into tbl_gen_login_history
                    (
                        fk_user_code,
                        created_at
                    ) values(
                        d_code,
                        now()
                    );

                    update tbl_gen_users
                        set
                            bool_online = 1,
                            dtm_last_connection = now()
                    where int_code = d_code;

                end if;

                set @sql = (\"
                    select
                        us.int_code as code,
                        us.vch_first_name as first_name,
                        us.vch_second_name as second_name,
                        us.vch_middle_name as middle_name,
                        us.vch_last_name as last_name,
                        us.bool_verified_account as verified_account
                    from tbl_gen_users us
                    where us.vch_email = pVch_email
                    and us.vch_password = pVch_password;
                \");

                prepare request from @sql;
                execute request;
                deallocate prepare request;

            end;
        ";

        DB::unprepared("drop procedure if exists sp_authenticate_user");
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

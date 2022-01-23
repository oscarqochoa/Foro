<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

use App\Helpers\JwtAuth;
use App\Helpers\Response;

class AuthenticationController extends Controller
{
    public function authenticate(Request $request)
    {

        $jwtAuth = new JwtAuth();

        $json = $request->input("json", null);
        $params = json_decode($json);
        $params_array = json_decode($json, true);

        $validate = Validator::make($params_array, [
            "vch_email" => "required",
            "vch_password" => "required"
        ]);

        if ($validate->fails()) {
            $signup = Response::errorValidation($validate->errors());
        } else {

            $pwd = hash("sha256", $params->vch_password);
            $signup = $jwtAuth->signup($params->vch_email, $pwd);

            if (!empty($params->gettoken)) {
                $signup = $jwtAuth->signup($params->vch_email, $pwd, true);

                $sl_statement = "call sp_register_sessions_log(?)";
                $sl_parameters = [
                    $signup->sub
                ];

                DB::select($sl_statement, $sl_parameters);
            }
        }
        return response()->json($signup, 200);
    }
}

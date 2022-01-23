<?php

namespace App\Helpers;

use Firebase\JWT\JWT;
use Illuminate\Support\Facades\DB;

class JwtAuth
{

    public function __construct()
    {
        $this->key = 'MEDqOzgsPPo-y}+i+ta@uAsCASH';
        $this->sp = "CALL sp_authenticate_user(?,?)";
    }

    public function signup(String $username, String $password, $gettoken = null)
    {

        $user = DB::select($this->sp, array(
            $username, $password
        ));

        $signup = false;

        if (!empty($user) && $user[0]->verified_account) {
            $signup = true;
        }

        if ($signup) {

            $token = array(
                "sub" => $user[0]->code,
                "first_name" => $user[0]->first_name,
                "second_name" => $user[0]->second_name,
                "middle_name" => $user[0]->middle_name,
                "last_name" => $user[0]->last_name,
                'iat' => time(),
                'exp' => time() + (180 * 400)
            );


            $jwt = JWT::encode($token, $this->key, "HS256");
            $decoded = JWT::decode($jwt, $this->key, ["HS256"]);



            if (is_null($gettoken)) {
                $data = $jwt;
            } else {
                $data = $decoded;
            }
        } else {

            $data = array(
                "status" => "error",
                "message" => "Incorrect Login"
            );
        }

        return $data;
    }

    public function checkToken($jwt, $getIdentity = false)
    {

        $auth = false;

        try {
            $jwt = str_replace('"', '', $jwt);
            $decoded = JWT::decode($jwt, $this->key, ['HS256']);
        } catch (\UnexpectedValueException $e) {
            $auth = false;
        } catch (\DomainException $e) {
            $auth = false;
        }

        if (!empty($decoded) && is_object($decoded) && isset($decoded->sub)) {
            $auth = true;
        } else {
            $auth = false;
        }

        if ($getIdentity) {
            return $decoded;
        }

        return $auth;
    }

    public static function checkUser($jwt, $getIdentity = true)
    {
        $auth = false;
        $key = 'MEDqOzgsPPo-y}+i+ta@uAsCASH';

        try {
            $jwt = str_replace('"', '', $jwt);
            $decoded = JWT::decode($jwt, $key, ['HS256']);
        } catch (\UnexpectedValueException $e) {
            $auth = false;
        } catch (\DomainException $e) {
            $auth = false;
        }

        if (!empty($decoded) && is_object($decoded) && isset($decoded->sub)) {
            $auth = true;
        } else {
            $auth = false;
        }

        if ($getIdentity) {
            return $decoded;
        }

        return $auth;
    }
}

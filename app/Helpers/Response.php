<?php

namespace App\Helpers;

class Response
{

    /**
     * List data
     *
     * @author Oscar Quiroz
     * @param Int $code
     * @param String $status
     * @param Array $data
     * @static
     * @return Array
     */
    public static function list(
        Int $code,
        String $status,
        array $data
    ) {

        $message = (empty($data)) ? "No data" : "List";

        return array(
            "code" => $code,
            "status" => $status,
            "message" => $message,
            "registers" => count($data),
            "data" => $data
        );
    }

    /**
     * Validation has fails
     *
     * @author Oscar Quiroz
     * @param Array $errors
     * @static
     * @return Array
     */
    public static function errorValidation($errors)
    {
        return array(
            "code" => 400,
            "status" => "error",
            "message" => "The data is invalid or incomplete",
            "errors" => $errors
        );
    }


    /**
     * Register response
     *
     * @author Oscar Quiroz
     * @param Int $code
     * @param String $status
     * @param String $id
     * @static
     * @return Array
     */
    public static function register(
        Int $code,
        String $status,
        String $id
    ) {

        $message = ($status == "success") ? "Successfully registered" : "Register error";

        if ($id == "0") $message = "Already registered";

        return array(
            "code" => $code,
            "status" => $status,
            "message" => $message,
            "last_code" => $id
        );
    }

    /**
     * Update response
     *
     * @author Oscar Quiroz
     * @param Int $code
     * @param String $status
     * @static
     * @return Array
     */
    public static function update(
        Int $code,
        String $status
    ) {

        $message = ($status == "success") ? "Successfully updated" : "Update error";

        return array(
            "code" => $code,
            "status" => $status,
            "message" => $message
        );
    }

    /**
     * Delete response
     *
     * @author Oscar Quiroz
     * @param Int $code
     * @param String $status
     * @static
     * @return Array
     */
    public static function delete(
        Int $code,
        String $status
    ) {

        $message = ($status == "success") ? "Successfully deleted" : "Delete error";

        return array(
            "code" => $code,
            "status" => $status,
            "message" => $message
        );
    }

    /**
     * No data response
     *
     * @author Oscar Quiroz
     * @static
     * @return Array
     */
    public static function noData()
    {
        return array(
            "code" => 400,
            "status" => "error",
            "message" => "No hay datos"
        );
    }
}

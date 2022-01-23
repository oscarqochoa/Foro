<?php

namespace App\Helpers;

class ValidateParams
{
    /**
     * Validate params
     *
     * @author Oscar Quiroz
     * @param
     * @return
     */
    public static function integer(
        $param
    ) {
        if ($param != "" && $param != null) {
            return $param;
        } else {
            return 0;
        }
    }

    /**
     * Validate params
     *
     * @author Oscar Quiroz
     * @param
     * @return
     */
    public static function string(
        $param
    ) {
        if ($param != "" && $param != null) {
            return $param;
        } else {
            return "";
        }
    }

    /**
     * Validate params
     *
     * @author Oscar Quiroz
     * @param
     * @return
     */
    public static function date(
        $param
    ) {
        if ($param != "" && $param != null) {
            return $param;
        } else {
            return "0000-00-00";
        }
    }
}

<?php

if (!function_exists('responseJson')) {
    function responseJson($code, $message = '', $data = array())
    {
        return response()->json(array(
            'code'      => $code,
            'message'   => $message,
            'data'      => $data,
        ));
    }
}

if (!function_exists('successJson')) {
    function successJson($message = '', $data = array())
    {
        return responseJson('success', $message, $data);
    }
}

if (!function_exists('errorJson')) {
    function errorJson($message = '', $data = array())
    {
        return responseJson('error', $message, $data);
    }
}

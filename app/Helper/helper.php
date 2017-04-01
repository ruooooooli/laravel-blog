<?php

if (! function_exists('responseJson')) {
    function responseJson($code, $message = '', $data = array(), $status = 200)
    {
        return response()->json(array(
            'code'          => $code,
            'message'       => $message,
            'data'          => $data,
            'status_code'   => $status,
        ));
    }
}

if (! function_exists('successJson')) {
    function successJson($message = '', $data = array(), $status = 200)
    {
        return responseJson('success', $message, $data, $status);
    }
}

if (! function_exists('errorJson')) {
    function errorJson($message = '', $data = array(), $status = 200)
    {
        return responseJson('error', $message, $data, $status);
    }
}

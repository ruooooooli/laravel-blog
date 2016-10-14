<?php

function responseJson($code, $message = '', $data = array())
{
    return response()->json(array(
        'code'      => $code,
        'message'   => $message,
        'data'      => $data,
    ));
}

function successJson($message = '', $data = array())
{
    return responseJson('success', $message, $data);
}

function errorJson($message = '', $data = array())
{
    return responseJson('error', $message, $data);
}

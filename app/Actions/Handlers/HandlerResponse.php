<?php

namespace App\Actions\Handlers;

/**
 * Handler Response JSON data
 */
class HandlerResponse
{
    /**
     * @param int $status
     * @return string $message
     */
    private static function getMessage($status)
    {
        $msg = '';
        switch ($status) {
            case 200:
                $msg = 'OK.';
                break;
            case 201:
                $msg = 'Created.';
                break;
            case 400:
                $msg = 'Bad Request.';
                break;
            case 401:
                $msg = 'Unauthenticated.';
                break;
            case 403:
                $msg = 'Forbidden.';
                break;
            case 404:
                $msg = 'Not Found.';
                break;
            case 405:
                $msg = 'Method Not Allowed.';
                break;
            case 422:
                $msg = 'Validation Errors.';
                break;
            case 500:
                $msg = 'Internal Server Error.';
                break;
            default:
                break;
        }
        return $msg;
    }

    /**
     * @param  int $status [200, 201, 400, 401, 403, 404, 405, 422, 500]
     * @param  mixed $data 
     * @return \Illuminate\Http\Response
     */
    public static function responseJSON($data = [], $status = 200)
    {
        if ($status >= 200 && $status < 400)
            return response()->json([
                'message'   => $data['message'] ?? self::getMessage($status),
                'data'      => $data['data']    ?? [],
                'meta'      => $data['meta']    ?? [],
            ], $status);
        else
            return response()->json([
                'message'  => $data['message']  ?? self::getMessage($status),
                'errors'   => $data['errors']   ?? [],
            ], $status);
    }
}

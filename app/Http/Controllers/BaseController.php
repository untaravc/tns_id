<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BaseController extends Controller
{
    public function sendResponse($result = null, $message = null)
    {
        $response = [
            'status' => true,
            'result' => $result ?? null,
        ];

        $status_code = 200;

        switch ($message) {
            case 211:
                $response['message'] = 'Data Created';
                $status_code = 201;
                break;
            case 212:
                $response['message'] = 'Data Updated';
                $status_code = 201;
                break;
            default :
                $response['message'] = $message ?? 'Success.';
        }

        return response()->json($response, $status_code);
    }

    public function sendError($error, $errorMessages = [], $code = 404)
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];

        if (!empty($errorMessages)) {
            $response['result'] = $errorMessages;
        }

        return response()->json($response, $code);
    }

    public function unauthorizedResponse($error = 'Forbidden', $code = 403)
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];

        return response()->json($response, $code);
    }

    public function sendValidator($errors)
    {
        $response = [
            'success' => false,
            'message' => $errors->first(),
            'result'  => $errors
        ];

        return response()->json($response, 422);
    }
}

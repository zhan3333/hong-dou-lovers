<?php
/**
 * @author zhan <grianchan@gmail.com>
 * 2017/6/10 17:31
 */

namespace App\Api\V1\Controllers;


use Dingo\Api\Routing\Helpers;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;

class BaseController extends Controller
{
    use Helpers, ValidatesRequests;

    /**
     * 格式化输出
     * @param array $result
     * @param string $error_code
     * @param string $message
     * @param array $error_result
     * @return \Illuminate\Http\JsonResponse
     */
    public function formatReturn($result = [], $error_code = '0', $message = '', $error_result = [])
    {
        return response()->json([
            'result' => $result,
            'error_code' => $error_code,
            'message' => $message,
            'error_result' => $error_result
        ]);
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * 统一的 post 的返回格式
     *
     * @param int $code     错误码  16进制
     * @param string $msg   返回信息
     * @param null $data    返回数据
     * @return \Illuminate\Http\JsonResponse    json数据
     */
    function json_response($code = 0, $msg = "", $data = null){
        return response()->json(['code' => $code, 'msg' => $msg, 'data' => $data]);
    }
}

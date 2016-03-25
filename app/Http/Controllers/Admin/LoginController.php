<?php
/**
 * Created by PhpStorm.
 * User: ling
 * Date: 2016/3/23
 * Time: 14:42
 */
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Gregwar\Captcha\CaptchaBuilder;
use App\Login;

define('VERiFYCODE_ERROR', 0xA001);    // 验证码错误
define('ACCOUNT_ERROR', 0xA002);    // 用户名或密码错误

class LoginController extends Controller
{
    public $builder;

    /**
     * LoginController constructor.
     */
    public function __construct() {
        $this->builder = new CaptchaBuilder;
    }

    /**
     * login page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        return view('admin.login');
    }

    /**
     * 处理  login数据
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function do_login( Request $request ) {
        $account  = trim($request->input('account'));
        $password = md5(trim($request->input('password')));
        $verifycode = trim($request->input('verifycode'));

        if(empty($verifycode) || $request->session()->get('milkcaptcha') != $verifycode){
            return $this->json_response(VERiFYCODE_ERROR, '验证码错误' . $request->session()->get('milkcaptcha'));
        }

        $model = new Login();
        $user = $model->find_user($account, $password, 'admin');
        if($user){
            // 写入session  记录登录信息
            $request->session()->put('admin_id', $user->id);
            $request->session()->put('admin_account', $user->account);
            return $this->json_response(0x0, 'success', url('admin/index'));
        }

        return $this->json_response(ACCOUNT_ERROR, '用户名或密码错误');
    }

    /**
     * 生成验证码图片
     * @param Request $request
     * @param $tmp.
     */
    public function get_verifycode( Request $request, $tmp) {
        //生成验证码图片的Builder对象，配置相应属性
        $builder = $this->builder;
        //可以设置图片宽高及字体
        $builder->build($width = 300, $height = 80, $font = null);
        //获取验证码的内容
        $phrase = $builder->getPhrase();

        //把内容存入session
        $request->session()->flash('milkcaptcha', $phrase);
        //生成图片
        header("Cache-Control: no-cache, must-revalidate");
        header('Content-Type: image/jpeg');
        $builder->output();
    }

}
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
use App\Login;
class LoginController extends Controller
{
    public function index() {
        return view('admin.login');
    }


    public function do_login( Request $request ){
        $account  = trim($request->input('account'));
        $password = md5(trim($request->input('password')));
        $model = new Login();
        $user = $model->find_user($account, $password, 'admin');
        if($user){
            $request->session()->put('admin_id', $user->id);
            $request->session()->put('admin_account', $user->account);
            return url('admin/index');
        }
        return 0;
    }

}
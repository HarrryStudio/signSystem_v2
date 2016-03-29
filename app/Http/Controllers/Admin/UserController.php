<?php
/**
 * Created by PhpStorm.
 * User: ling
 * Date: 2016/3/23
 * Time: 14:57
 */

namespace App\Http\Controllers\Admin;



use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    //测试时使用弹出欢迎Laravel的欢迎页面
    public function index(){
        return view('welcome');
    }

    //创建用户的页面
    public function create(){
        $groups = DB::table('group')->get();
        return view('admin.create',compact('groups'));
    }

    //添加用户的函数
    public function addUsers(Request $request){
        //接受POST过来的数据
        //存入数据库
        //重定向
        $email_zz = "/^([0-9A-Za-z\\-_\\.]+)@([0-9a-z]+\\.[a-z]{2,3}(\\.[a-z]{2})?)$/i";//email正则
        $user_name_zz = "/^[A-Za-z0-9_\u4e00-\u9fa5]{3,15}$/";//用户名正则
        $user_pasd_zz = "/^[^\u4e00-\u9fa5\s]{6,20}$/";//密码正则

//带正则判断
/*        $user_name = preg_replace($user_name_zz,trim($request->input('userName')));//用户名
        $pasd = preg_replace($user_pasd_zz,trim($request->input('pasd')));//密码
        $group = trim($request->input('group'));//组别
        $stuid = trim($request->input('stuid'));//学生id
        $class = trim($request->input('class'));//班级
        $phone = preg_replace("/^1[34578]\d{9}$/",trim($request->input('phone')));//手机号
        $email = preg_replace($email_zz,trim($request->input('email')));//电子邮件
        $qq = preg_replace('/^[1-9][0-9]{4,9}$/',trim($request->input('qq')));//QQ号
        $address = trim($request->input('address'));//家庭地址*/

        $account = trim($request->account);//用户名
        $user_name = trim($request->userName);//姓名
        $group = trim($request->group);//组别
        $group_id = DB::table('group')->where('name',$group)->get(['id']);//组别id
        if(trim($request->rank)=='平民'){
            $rank = 0;
        }else{
            $rank = 1;
        }
        DB::beginTransaction();
        try{
//中间逻辑代码DB::commit();
            $is_exist = DB::table('login')->where('account',$account)->first();
            if(count($is_exist)==0) {
                $user_id = DB::table('user')->insertGetId([
                    'name' => $user_name,
                    'group_id' => $group_id[0]->id,
                    'created_at' => time(),
                ]);
                DB::table('login')->insertGetId([
                    'user_id' => $user_id,
                    'account' => $account,
                    'password' => md5("marchsoft@2016"),
                    'rank' => $rank,
                    'created_at' => time(),
                ]);
                DB::commit();
                return "OK";
            }else{
                DB::rollBack();
                return "用户已经存在！";
            }
                //return redirect('/admin/showUsers');
        }catch (\Exception $e) {
            //接收异常处理并回滚 DB::rollBack();
            DB::rollBack();
            return "用户已经存在！";
        }
    }

    //显示用户的函数
    public function showUsers(){

//        $users = DB::table('user')->whereIn(,function(){
//            DB::table('login')->where('status',0)-get();
//        })->get();
        $users = DB::table('user')
            ->leftJoin('login', 'user.id', '=', 'login.user_id')
            ->where('status',0)
            ->get();
        return view('admin.showUsers',compact('users'));//返回全部数据给视图
    }


    public function delUser(){


    }
}
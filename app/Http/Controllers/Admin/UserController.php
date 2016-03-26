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
use App\Users;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    //测试时使用弹出欢迎Laravel的欢迎页面
    public function index(){
        return view('welcome');
    }

    //创建用户的页面
    public function create(){
        return view('admin.create');
    }

    //添加用户的函数
    public function addUsers(Request $request){
        //接受POST过来的数据
        //存入数据库
        //重定向
        $user_name = trim($request->input('userName'));//用户名
        $pasd = trim($request->input('pasd'));
        $group = trim($request->input('group'));
        $stuid = trim($request->input('stuid'));
        $class = trim($request->input('class'));
        $phone = trim($request->input('phone'));
        $email = trim($request->input('email'));
        $qq = trim($request->input('qq'));
        $address = trim($request->input('address'));

        switch ($group) {
            case "开发一组":
                $group_id = 1;
                break;
            case "开发二组":
                $group_id = 2;
                break;
            case "开发三组":
                $group_id = 3;
                break;
            case "开发四组":
                $group_id = 4;
                break;
            case "开发五组":
                $group_id = 5;
                break;
            default:
                $group_id = 0;
        }

//        $users = DB::table('users')->get();

        $id = DB::table('users')->insertGetId(
            ['name' => $user_name,
            'group_id' => $group_id,
            'stu_id' => $stuid,
            'class' => $class,
            'phone' => $phone,
            'email' => $email,
            'qq' => $qq,
            'address' => $address
            ]);


        $users = DB::table('users')->get();//实例化数据表，并读取全部数据
//        $users = Users::all();
        return view('admin.showUsers',compact('users'));//返回全部数据给视图
//        return view('admin.create');

        /*        $user_model = new Users();
                $user_model->name = "haha";
                $user_model->save();*/


//        $user_model->name = $user_name;
//        $user_model->group='4';
//        $user_model->stu_id=$stuid;
//        $user_model->class=$class;
//        $user_model->phone=$phone;
//        $user_model->email=$email;
//        $user_model->qq=$qq;
//        $user_model->address=$address;

    }

    //显示用户的函数
    public function showUsers(){
        $users = Users::all();//实例化数据表，并读取全部数据
        return view('admin.showUsers',compact('users'));//返回全部数据给视图
    }


}
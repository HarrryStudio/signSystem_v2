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

define('REGISTERED_ERROR', 0xE001);    // 用户添加失败
define('RESETPASD_ERROR', 0xE002);    // 密码重置失败
define('ALTER_ERROR', 0xE003);    // 保存失败
define('ACCOUNT_ERROR',0xE004);    //用户名字出现不合法

class UserController extends Controller
{
    //测试时使用弹出欢迎Laravel的欢迎页面
    public function index(){
        return view('welcome');
    }
    //创建用户的页面
    public function create(){
        $groups = DB::table('groups')->get();
        return view('admin.create',compact('groups'));
    }

    //添加用户的函数
    public function addUsers(Request $request)
    {
        //接受POST过来的数据
        //存入数据库
        //重定向
//        $email_zz = "/^([0-9A-Za-z\\-_\\.]+)@([0-9a-z]+\\.[a-z]{2,3}(\\.[a-z]{2})?)$/i";//email正则
        $user_name_zz = "/^[a-z]+$/";//用户名正则
//        $user_pasd_zz = "/^[^\u4e00-\u9fa5\s]{6,20}$/";//密码正则
        if (preg_match($user_name_zz, trim($request->input('account')))) {
            $account = trim($request->input('account'));//用户名
            $user_name = trim($request->input('userName'));//姓名
            $group = trim($request->input('group'));//组别
            $group_id = DB::table('groups')->where('name', $group)->get(['id']);//组别id
            if (trim($request->input('rank')) == '平民') {
                $rank = 0;
            } else {
                $rank = 1;
            }
            DB::beginTransaction();
            try {
//中间逻辑代码DB::commit();
                $is_exist = DB::table('login')->where('account', $account)->first();
                if (count($is_exist) == 0) {
                    $user_id = DB::table('users')->insertGetId([
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
                    $data = [
                        'msg' => "很好~添加成功了",
                    ];
                    return $this->json_response(0x0, "很好~添加成功了", $data);
                } else {
                    DB::rollBack();
                    $data = [
                        'msg' => '啊呀~添加失败了',
                    ];
                    return $this->json_response(REGISTERED_ERROR, '啊呀~添加失败了', $data);
                }

                //return redirect('/admin/showUsers');
            } catch (\Exception $e) {
                //接收异常处理并回滚 DB::rollBack();
                DB::rollBack();
                $data = [
                    'msg' => '啊呀~添加失败了',
                ];
                return $this->json_response(REGISTERED_ERROR, '啊呀~添加失败了', $data);
            }
        }else{
            $data = [];
            return $this->json_response(ACCOUNT_ERROR, '用户名出现不合法', $data);
        }
    }

    //显示用户的函数
    public function showUsers(){

        $users = DB::table('users')
            ->select(['groups.name as group_name','users.name', 'login.account','users.phone','users.class','groups.id'])
            ->leftJoin('login', 'users.id', '=', 'login.user_id')
            ->leftJoin('groups', 'users.group_id', '=', 'groups.id')
            ->where('login.status',0)->paginate(15);

        return view('admin.showUsers',compact('users'));//返回全部数据给视图
    }

//删除用户逻辑删除
    public function delUser($account){
        DB::table('login')
            ->where('account',$account)
            ->update(['status'=>1]);
        return redirect('/admin/showUsers');
    }

//批量删除
    public function batchDel(Request $request){
        $arr =  $request->input('data');
        DB::table('login')
            ->whereIn('account', $arr)
            ->update(['status' => 1]);

        $data = [];
        return $this->json_response(0x0, '成功删除！',$data);
    }



//查找用户
    public function findUser(Request $request,$account){
        $users = DB::table('users')
            ->select(['groups.name as group_name','users.name', 'login.account','users.phone','users.class'])
            ->leftJoin('login', 'users.id', '=', 'login.user_id')
            ->leftJoin('groups', 'users.group_id', '=', 'groups.id')
            ->where('login.status',0)
            ->where(function ($query) use ($account){
                $query->where('login.account',$account)
                    ->orWhere('users.name', $account);
            })
//            ->where('login.account',$account)
//            ->orWhere('name', $account)
            ->paginate(15);
        return view('admin.showUsers',['users'=>$users, 'now'=>$account]);//返回全部数据给视图

    }
//修改用户的信息
    public function update($account){

        $users = DB::table('users')
            ->leftJoin('login', 'users.id', '=', 'login.user_id')
            ->where('account',$account)
            ->first(['account','name','group_id','rank','login.id']);

        $group_name = DB::table('groups')
            ->where('id',$users->group_id)
            ->first(['name']);

        $groups = DB::table('groups')->get();

        return view('/admin/updateUser',['user'=>$users,'group_name'=>$group_name,'groups'=>$groups]);
    }



//重置密码
    public function resetpasd(Request $request){
        DB::beginTransaction();
        try{
            DB::table('login')
                ->where('account',$request->input('account'))
                ->update(['password'=>md5('marchsoft@2016')]);
            DB::commit();
            $data = [
                'code'=>0,
                'msg'=>'密码已成功重置！',
            ];
            return $this->json_response(0x0, '密码已成功重置',$data);
        }catch(\Exception $e){
            DB::rollBack();
            $data = [
                'msg'=>'啊呀~密码重置失败了',
            ];
            return $this->json_response(RESETPASD_ERROR, '啊呀~密码重置失败了',$data);
        }

    }


//修改用户信息操作

    public function alter(Request $request){
        $account = $request->input('account');
        $name = $request->input('userName');
        $login_id = $request->input('tmp');
        if($request->input('rank')=='平民'){
            $rank = 0;
        }else{
            $rank = 1;
        }
        DB::beginTransaction();
        try{
            $group_id = DB::table('groups')
                ->where('name', $request->input('group'))
                ->first();  //$group_id->id

            $user_id = DB::table('login')
                ->where('id', $login_id)
                ->first();  //$user_id->user_id

            DB::table('login')
                ->where('id', $login_id)
                ->update(['rank' => $rank, 'account' => $account]);

            DB::table('users')
                ->where('id', $user_id->user_id)
                ->update(['name' => $name, 'group_id' => $group_id->id]);
            DB::commit();

            $data = [
                'msg' => 'GOOD',
            ];
            return $this->json_response(0x0, "很好~保存成功了", $data);

        }catch(\Exception $e){
            DB::rollBack();
            $data = [
                'msg'=>'BAD',
            ];
            return $this->json_response(ALTER_ERROR,"失败咯~！",$data);
        }
    }





}
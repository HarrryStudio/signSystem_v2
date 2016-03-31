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

        $account = trim($request->input('account'));//用户名
        $user_name = trim($request->input('userName'));//姓名
        $group = trim($request->input('group'));//组别
        $group_id = DB::table('group')->where('name',$group)->get(['id']);//组别id
        if(trim($request->input('rank'))=='平民'){
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
                $data = [
                    'msg' => "很好~添加成功了",
                ];
                return $this->json_response(0x0,"很好~添加成功了",$data);
            }else{
                DB::rollBack();
                $data = [
                    'msg'=>'啊呀~添加失败了',
                ];
                return $this->json_response(REGISTERED_ERROR, '啊呀~添加失败了',$data);
//                return $this->json_response($code,"addUser error",$data);
                /*$result = "添加用户失败！";
                return redirect('/admin/create/'.$result);*/
            }

                //return redirect('/admin/showUsers');
        }catch (\Exception $e) {
            //接收异常处理并回滚 DB::rollBack();
            DB::rollBack();
            $data = [
                'msg'=>'啊呀~添加失败了',
            ];
            return $this->json_response(REGISTERED_ERROR, '啊呀~添加失败了',$data);
//            return $this->json_response($data);
            /*$result = "添加用户失败！";
            return redirect('/admin/create');*/
        }
    }

    //显示用户的函数
    public function showUsers(){

//        $users = DB::table('user')->whereIn(,function(){
//            DB::table('login')->where('status',0)-get();
//        })->get();
        $users = DB::table('user')
            ->select(['group.name as group_name','user.name', 'login.account','user.phone','user.class'])
            ->leftJoin('login', 'user.id', '=', 'login.user_id')
            ->leftJoin('group', 'user.group_id', '=', 'group.id')
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


//修改用户的信息
    public function update($account){
  /*      $users = DB::table('user')
            ->Join( 'user.id', '=', 'login.user_id')
            ->where('account',$account)
            ->get(['']);*/

//        group_id
//        rank

        $users = DB::table('user')
            ->leftJoin('login', 'user.id', '=', 'login.user_id')
            ->where('account',$account)
            ->first(['account','name','group_id','rank','login.id']);

//        $users = DB::table('user')
//            ->leftjoin('login', 'user.id', '=', 'login.user_id')
//            ->where('account',$account)
//            ->get(['login.account','user.name,']);

//        dd($users);

        $group_name = DB::table('group')
            ->where('id',$users->group_id)
            ->first(['name']);

//        dd($group_name->name);

        $groups = DB::table('group')->get();

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
            $group_id = DB::table('group')
                ->where('name', $request->input('group'))
                ->first();  //$group_id->id

            $user_id = DB::table('login')
                ->where('id', $login_id)
                ->first();  //$user_id->user_id

            DB::table('login')
                ->where('id', $login_id)
                ->update(['rank' => $rank, 'account' => $account]);

            DB::table('user')
                ->where('id', $user_id->user_id)
                ->update(['name' => $name, 'group_id' => $group_id->id]);
            DB::commit();
//        DB::table('user')
//            ->leftJoin('login', 'user.id', '=', 'login.user_id')
//            ->where('account',$request->input('account'))
//            ->update(['account'=>$account,'rank'=>$rank,'name'=>$name,'group_id'=>$group_id]);

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




    //测试使用  疯狂的向数据插入数据
/*    public function xunhuan(){

        for($i = 1;$i<=1000;$i++){
            $user_id = DB::table('user')->insertGetId(
                ['name'=>$i,'group_id'=>1]
            );
            DB::table('login')->insertGetId([
                'user_id' => $user_id,
                'account' => $i+"a",
                'created_at' => time(),
            ]);
        }
        return 'OK';
    }*/

}
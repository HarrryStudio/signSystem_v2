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

class GroupController extends Controller
{
    //测试时使用弹出欢迎Laravel的欢迎页面
    public function index(){

    	$groups= DB::select('SELECT groups.id, groups.name, COUNT(users.id) as counts FROM users RIGHT JOIN groups ON users.group_id = groups.id GROUP BY groups.id');

    	//return $groups;
        return view('admin.group_index',['groups' => $groups]);
    }

    public function selectGroupUsers($id){
    	$group_user = DB:: select("SELECT * FROM users where group_id =$id");

    	return $group_user;
    }

    public function createGroup($name){
    	$data = DB::table('groups')->insert(
    		array('name'=>$name,'created_at'=>time())
    		);

    	if($data)
    		return $this->json_response('','添加成功');			
    	
			
    	return $this->json_response('','添加失败');
    }

    public function updateGroup($id,$name){
    	$data = DB::table('groups')
    				->where('id',$id)
    				->update(array('name'=>$name,'updated_at'=>time()));

    	return $data;	//1：成功 0：失败
    	/*if($data)
    		return $this->json_response('','更新成功');			
    	
			
    	return $this->json_response('','更新失败');*/

    }
}
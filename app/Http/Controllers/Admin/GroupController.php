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

define('CREATE_ERROR', 0xA101);    // 添加失败
define('UPDATE_ERROR', 0xA102);    // 更新失败
define('DELETE_ERROR', 0xA103);    // 删除失败

class GroupController extends Controller
{
    /**
    *组别首页，显示级别组别信息
    */
    public function index(){

    	$groups= DB::select('SELECT groups.id, groups.name, COUNT(users.id) as counts FROM users RIGHT JOIN groups ON users.group_id = groups.id GROUP BY groups.id');

    	//return $groups;
        return view('admin.group_index',['groups' => $groups]);
    }

    public function selectGroupUsers($id){
    	$group_user = DB:: select("SELECT * FROM users where group_id =$id");

    	return $group_user;
    }

    /**
     * 创建组
     * @param int name 预设置组名称
     * @return json
     */
    public function createGroup($name){
    	$data = DB::table('groups')->insert(
    		array('name'=>$name,'created_at'=>time())
    		);

    	if($data)
    		return $this->json_response('','添加成功');			
    	
			
    	return $this->json_response('CREATE_ERROR','添加失败，请核对后重试');
    }

    /**
     * 更新组名称
     * @param int id 目标组id
     * @param string name 预设置文字
     * @return json
     */
    public function updateGroup($id,$name){
    	$data = DB::table('groups')
    				->where('id',$id)
    				->update(array('name'=>$name,'updated_at'=>time()));

    	if($data)
    		return $this->json_response(0,'更新成功');			
    	
			
    	return $this->json_response('UPDATE_ERROR','更新失败，请核对后重试');

    }

    /**
     * 删除组
     * @param int id 目标组id
     * @return json
     */
    public function delGroup($id){
        $group_count = DB::select("SELECT count(*) as count FROM users where group_id =$id");

        $counts = $group_count["0"]->count;

        if($counts>0)
            return $this->json_response('DELETE_ERROR','该组还存在人员，禁止该操作');

        $data = DB::table('groups')->where('id',$id)->delete();
        if($data=1)
             return $this->json_response(0,'成功删除');

        return $this->json_response('DELETE_ERROR','未知错误，删除失败');
    }

    /**
     * 修改用户组别
     * @param int u_id：用户id
     * @param int group_id： 目标组id
     * @return json
     */
    //$.post('http://signsystem.cn:81/admin/changeGroup',$('input[type=checkbox]:checked').serialize()+"&group_id=3",function(data){console.log(data)})
    public function changeGroup(Request $request){
        return $request->get('group_id');
        $ids = $request->get('ids');
        $group_id = $request->get('group_id');

        foreach ($ids as $key => $value) {
            $data = DB::table('users')
                    ->where('id',$u_id)
                    ->update(array('group_id'=>$group_id,'updated_at'=>time()));
            if(!$data)
                return $this->json_response('UPDATE_ERROR','部分更新失败，请核对后重试');
        }

        return $this->json_response(0,'更新成功');         
    }
}
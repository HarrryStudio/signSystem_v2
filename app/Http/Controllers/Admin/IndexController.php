<?php
/**
 * Created by PhpStorm.
 * User: ling
 * Date: 2016/3/24
 * Time: 8:17
 */

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Support\Facades\DB;
class IndexController  extends AdminController
{
    public function index(){
    	
        $users= DB::select('select count(*) as count from users');
    	/*$users = array(
    			'1'=>array('name' => "wml"),
    			'2'=>array('name' => "lb"),
    			'3'=>array('name' => "ldh")
    		);*/
        return view('admin.index', ['users' => $users['0']]);

        
        //return $users;
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: ling
 * Date: 2016/3/24
 * Time: 8:17
 */

namespace App\Http\Controllers\Admin;
use App\User;

class IndexController  extends AdminController
{
    public function index(){
    	
    	// $model = new user();
     //    $users= $model->select_all();
    	$users = array(
    			'id'=>'1'
    		);
        return view('admin.index', ['users' => $users]);
        //return view('admin.index');
    }
}
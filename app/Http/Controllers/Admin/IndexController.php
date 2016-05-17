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
        $groups= DB::select('select count(*) as count from groups');
    	
        return view('admin.index', ['users_count' => $users['0']->count,'groups_count' => $groups['0']->count]);

        
        //return $users;
    }
}
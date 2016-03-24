<?php
/**
 * Created by PhpStorm.
 * User: ling
 * Date: 2016/3/24
 * Time: 8:17
 */

namespace App\Http\Controllers\Admin;


class IndexController  extends AdminController
{
    public function index(){
        return view('admin.index');
    }
}
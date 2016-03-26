<?php
/**
 * Created by PhpStorm.
 * User: MrLiu
 * Date: 2016/3/26
 * Time: 8:56
 */

namespace App;

use App\Http\Requests\Request;
use Illuminate\Database\Eloquent\Model;

class Users extends Model{

    protected $table = 'users';


    public function create_user(Request $request){

    }

}
<?php
/**
 * Created by PhpStorm.
 * User: ling
 * Date: 2016/3/23
 * Time: 16:13
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class Login extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'login';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['account', 'password'];


    public function find_user( $account, $password, $type = 'user'){
        if($type == 'admin'){
            $this->table = 'admin';
        }else{
            $this->table = 'login';
        }
        $user = $this->where( 'account', $account )->where( 'password', $password)->first();
        if(empty($user)){
            return false;
        }
        return $user;
    }
}
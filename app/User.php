<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'user';

    public function select_all(){
        $user = $this->select();
        return $user;
    }

}

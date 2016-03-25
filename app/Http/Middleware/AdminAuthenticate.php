<?php
/**
 * Created by PhpStorm.
 * User: ling
 * Date: 2016/3/23
 * Time: 15:45
 */

namespace App\Http\Middleware;
use Closure;
use App\Login;

class AdminAuthenticate
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        /*if(!$request->session()->has('admin_id')) {
            return redirect('admin_login');
        }*/
        return $next($request);
    }


    /**
     * check have a login user
     * @return boolea
     */
    static public function is_login( Request $request ){
        return 0;
    }

}
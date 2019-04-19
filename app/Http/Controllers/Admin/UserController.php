<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\LoginModel;

class UserController extends Controller
{
    //
    public function index()
    {
    	return view('admin.user.index');
    }

    public function pass(Request $request)
    {
    	if($request->isMethod('post')){
    		//dd($request -> input());
    		$password = $request->input('newpass');
    		$name = session('name');
    		 $user = new LoginModel;
            //return ['msg'=>'$msg','status'=>'success'];
            $res = $user->updata($name,$password);
            if($res){
            	return ['msg'=>'修改成功','status'=>'success'];
            }else{
            	return ['msg'=>'修改失败','status'=>'fail'];
            }
    	}
    	return view('admin.user.pass');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\LoginModel;
use Validator;

class LoginController extends Controller
{
    //
    public function index(){
    	return view('admin.login');
    }

    public function login(Request $request)
    {
    	//dd($requser->input());
    	$rules = ['code' => 'captcha'];
    	$message = ['code.captcha'=>'验证码输入不正确'];
            $validator = Validator::make(['code'=>$request->code], $rules,$message);
            if ($validator->fails())
            {
                $msg = $validator->errors()->first();
         		return ['msg'=>$msg,'status'=>'fail'];
            }
            
            $user = new LoginModel;
            //return ['msg'=>'$msg','status'=>'success'];
            $res = $user->chaklogin($request->name,$request->password);
            session(['name'=>$request->name]);

            return $res;
    }

    //退出登录
    public function logout()
    {
    	session(['name'=>null]);
    	return redirect('admin/login');
    }

    //匹配原密码是否正确
    public function charkpass(Request $request)
    {	
    	
    	$user = new LoginModel;
        $password = $request->input('param');
        $name = session('name');

        $res = $user->charkpass($name,$password);
        //dd($res);
        if($res['status']=='success'){
        	return ['info'=>'密码正确 可以修改','status'=>'y'];
        }else{
        	return ['info'=>'密码不正确 不可以修改','status'=>'n'];
        }
    }
}

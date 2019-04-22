<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\Model\UserModel;

class UserController extends Controller
{
    //

    public function login(Request $request){
    	if($request->isMethod('post')){

    		//获取验证码
    	 $code = trim($request->input('code'));

    	 $rules = ['code' => 'captcha'];
    	 $message = ['code.captcha'=>'验证码输入不正确'];
         $validator = Validator::make(['code'=>$code], $rules,$message);
         //验证码不正确
         if($validator->fails()){
         	$msg = $validator->errors()->first();
         	return ['msg'=>$msg,'status'=>'fail'];
         }

         $username = trim($request->input('username'));
         $password = trim($request->input('password'));
    		
    		$userModel = new UserModel;

    		$res = $userModel->checkUser($username,$password);

 		   return $res;
    	}


    	return view('home.user.login');
    }

    public function register(Request $request){
    	if($request->isMethod('post')){

    		//获取验证码
    	 $code = trim($request->input('code'));

    	 $rules = ['code' => 'captcha'];
    	 $message = ['code.captcha'=>'验证码输入不正确'];
         $validator = Validator::make(['code'=>$code], $rules,$message);
         //验证码不正确
         if($validator->fails()){
         	$msg = $validator->errors()->first();
         	return ['msg'=>$msg,'status'=>'fail'];
         }

         $username = trim($request->input('username'));
         $password = trim($request->input('password'));
    		
    		$userModel = new UserModel;

    		$res = $userModel->insertUser($username,$password);
 		   if($res){
 		   		  session(['user'=>$username ]);
           	      return ['msg'=>'注册陈宫','status'=>'success'];
       		 }else{
                 return ['msg'=>'注册失败','status'=>'fail'];
           }
    	}
    	return view('home.user.register');
    }

    public  function checkName(Request $request){
    	$username  = trim($request->input('param'));
    	$userModel = new UserModel;
    	$res = $userModel->checkName($username );
    	if($res['status']=='success'){
    		return ['info'=>'可以注册','status'=>'y'];
    	}else{
    		return ['info'=>'用户名已经存在','status'=>'n'];
    	}

    }

    public function logout(){
    	session(['user'=>null]);

    	return redirect('/');
    }
}

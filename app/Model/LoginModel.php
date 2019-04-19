<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class LoginModel extends Model
{
    protected $table = 'admin';
    public $timestamps = false;
   	//做验证数据
    public function chaklogin($name,$password)
    {	
    	
    	$user = self::where('name',$name)->first();
    	//dd($user);
    	if(!$user){
    		return ['msg'=>'没有此用户名','status'=>'fail'];
    	}

    	$user = $user->toArray();
    	$pass1 = md5($password.$user['salt']);

    	//判断密码
    	if($user['password']==$pass1){
    		return ['msg'=>'登陆成功','status'=>'success'];
    	}else{
    		return ['msg'=>'密码不正确','status'=>'fail'];
    	}
    }

    //验证原密码
    public function charkpass($name,$password)
    {
    	$res = $this->chaklogin($name,$password);
    	return $res;
    }

    //修改密码
    public function updata($name,$password)
    {	
    	$salt = str_random(6);
    	$password = md5($password.$salt);
    	$res = self::where('name',$name)->update(['salt'=>$salt,'password'=>$password]);
    	return $res;
    }
}

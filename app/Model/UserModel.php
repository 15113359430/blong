<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    protected $table = 'user';
    protected $dateFormat = 'U';

    //插入用户
    public function insertUser($username,$password){

    	$salt = str_random(6);

    	$password = md5($password.$salt);

    	$this->username = $username;
    	$this->password = $password;
    	$this->salt = $salt;

    	return $this->save();

    }


    //检测用户名是否存在

    public function checkName($username ){

    	$user = self::where('username',$username)->first();
    	if($user){
    		return ['status'=>'fail'];
    	}else{
    		return ['status'=>'success'];
    	}
    }

    //用户登陆

    public function checkUser($username,$password){
    	$user = self::where('username',$username)->first();

    	if(!$user){
    		return ['msg'=>'用户名不存在','status'=>'fail'];
    	}

        if(!$user['is_freeze']){
            return ['msg'=>'此用户已经被冻结','status'=>'fail'];
        }

    	$user = $user->toArray();

    	$pass = md5($password.$user['salt']);

    	if($pass!=$user['password']){
    		return ['msg'=>'密码不正确','status'=>'fail'];
    	}
    	session(['user'=>$username ]);
    	return ['msg'=>'登陆成功','status'=>'success'];

    }

    //获取用户

    public function getUsers(){
        return self::select('id','username','created_at','is_freeze')->orderBy('id','desc')->paginate(2);
    }

    //冻结用户

    public function freezeUser($id){
        $is_freeze = self::where('id',$id)->value('is_freeze');

        $is_freeze = intval(!$is_freeze);

       return  self::where('id',$id)->update(['is_freeze'=>$is_freeze]);
    }
}

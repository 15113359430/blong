<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\SystemModel;

class SystemController extends Controller
{
    //
    public function index(){
    	$system = new SystemModel;
        $res = $system->getsys();
    	return view('admin.system.index',['res'=>$res]);
    }

    //跳到修改页面
    public function edit()
    {	
    	$system = new SystemModel;
        $res = $system->getsys();
    	return view('admin.system.endit',['res'=>$res]);
    }

    public function update(Request $request)
    {
    	
    	$res = $request->except('_token');
    	//dd($res);
    	$system = new SystemModel;
        $res = $system->updata($res);
        if($res){
        	return ['msg'=>'修改成功','status'=>'success'];
        }else{
        	return ['msg'=>'修改失败','status'=>'fail'];
        }
    }
}

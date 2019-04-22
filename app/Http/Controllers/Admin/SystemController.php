<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\SystemModel;

class SystemController extends Controller
{
    //
    public function index(){

    	$systemModel = new SystemModel;

    	$sys = $systemModel->getSys();

    	return view('admin.system.index',['sys'=>$sys]);
    }


    public function edit(){
    	$systemModel = new SystemModel;

    	$sys = $systemModel->getSys();

    	return view('admin.system.edit',['sys'=>$sys]);
    }


    public  function update(Request $request){


    	$data = $request->except('_token');

		$systemModel = new SystemModel;

    	$res = $systemModel->upSys($data);	

    	if($res){
    		return ['msg'=>"修改成功",'status'=>'success'];
    	}else{
    		return ['msg'=>'修改失败','status'=>'fail'];
    	}

    }
}

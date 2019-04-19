<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SystemModel extends Model
{
     protected $table = 'system';
    public $timestamps = false;

    //获取数据
    public function getsys()
    {
    	$res = self::first();
    	return $res;
    }

    //修改
    public function updata($data)
    {	
    	$res = self::where('id',$data['id'])->update($data);
    	return $res;
    }

}

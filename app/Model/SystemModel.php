<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SystemModel extends Model
{
    //
    public $timestamps = false;
	protected $table = 'system';

    public function getSys(){

    	return self::first()->toArray();
    }

    public function upSys($data){
    	$res = self::where('id',$data['id'])->update($data);

    	return $res; 
    }
}

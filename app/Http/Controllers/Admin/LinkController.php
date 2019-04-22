<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\linkModel;

class LinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $linkModel = new linkModel;
        $links = $linkModel->getLinks();

        return view('admin.link.index',['links'=>$links]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.link.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data = $request->except('_token');
        $linkModel = new linkModel;
        $res = $linkModel->insertLink($data);

         if($res){
            return ['msg'=>'添加陈宫','status'=>'success'];
        }else{
            return ['msg'=>'添加失败','status'=>'fail'];
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $linkModel = new linkModel;
        $link = $linkModel->getLink($id);

        return view('admin.link.edit',['link'=>$link]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->except('_token','_method');
         $linkModel = new linkModel;
        $res = $linkModel->upLink($id,$data);

         if($res){
            return ['msg'=>'修改陈宫','status'=>'success'];
        }else{
            return ['msg'=>'修改失败','status'=>'fail'];
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $linkModel = new linkModel;
        $res = $linkModel->delLink($id);

         if($res){
            return ['msg'=>'修改陈宫','status'=>'success'];
        }else{
            return ['msg'=>'修改失败','status'=>'fail'];
        }

    }
}

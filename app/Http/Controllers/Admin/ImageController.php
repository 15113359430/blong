<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\ImageModel;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $imageModel = new ImageModel;
        $images = $imageModel->getImages();

   

        return view('admin.image.index')->with('images',$images);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.image.add');
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
        $imageModel = new ImageModel;
        $res = $imageModel->insertImage($data);
       
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
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $imageModel = new ImageModel;
        $image = $imageModel->getImage($id);
        return view('admin.image.edit')->with('image',$image);
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
        $imageModel = new ImageModel;
        $res = $imageModel->upImage($id,$data);
         if($res){
            return ['msg'=>'更新成功','status'=>'success'];
        }else{
            return ['msg'=>'更新失败','status'=>'fail'];
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
        $imageModel = new ImageModel;
        $res = $imageModel->delImage($id);

         if($res){
            return ['msg'=>'删除成功','status'=>'success'];
        }else{
            return ['msg'=>'删除失败','status'=>'fail'];
        }

    }

    public function upload(Request $request){
        $image  = $request->file('file');

        if($image->isValid()){

            $ext = $image->getClientOriginalExtension(); 
            $size = $image->getClientSize();


            $allow_ext = ['png','jpeg','png','jpg'];
            $allow_size = 1024*1024 ;



            if(!in_array($ext,$allow_ext) || $size>$allow_ext ){
               
               return 'fail';
            }

            $img_path = 'uploads/'.date('Y-m-d');

            $img_name = time().'.'.$ext;

            if($image->move($img_path ,$img_name)){
                $url = $img_path.'/'.$img_name;
                return ['status'=>'success','url'=>$url];
            }

            return 'fail';
        

        }


    }
}

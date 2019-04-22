<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\CatModel;
use App\Model\ArticleModel;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $articleModel = new ArticleModel;
        $articles = $articleModel->getArts();
        return view('admin.article.index',['articles'=>$articles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $catModel = new CatModel;
        $cats = $catModel->getCats();
        return view('admin.article.add',['cats'=>$cats]);
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
        $articleModel = new ArticleModel;
        $res = $articleModel->insertArticle($data);

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
        $catModel = new CatModel;
        $cats = $catModel->getCats();
        $articleModel = new ArticleModel;
        $article = $articleModel->getArticle($id);

        return view('admin.article.edit',['article'=>$article,'cats'=>$cats]);
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


         $articleModel = new ArticleModel;
        $res = $articleModel->upArticle($id,$data);
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
         $articleModel = new ArticleModel;
        $res = $articleModel->delArticle($id);
          if($res){
            return ['msg'=>'删除陈宫','status'=>'success'];
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

            $img_path = 'uploads/article/'.date('Y-m-d');

            $img_name = time().'.'.$ext;

            if($image->move($img_path ,$img_name)){
                $url = '/'.$img_path.'/'.$img_name;
                return ['errno'=>0,'data'=>[$url]];

            }

            return 'fail';

        }
    }
}

<?php
namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\ArticleModel;
use Validator;

class ArticleController extends Controller
{
    
    public function index(){
    	return view('home.article.index');
    }


    public function detail($id){
    	$ArticleModel = new ArticleModel;

    	$article = $ArticleModel->getArt($id);

    	if(isset($article['status']) && $article['status']=='fail'){
    		return redirect('/');
    	}

    	$preArt =  $ArticleModel->getPreArt($id);
    	$nextArt =  $ArticleModel->getNextArt($id);

    	 $ArticleModel->viewInc($id);

    	 $comments = $ArticleModel->getComments($id);

    	 $num = $ArticleModel->getCommentNum($id);


    	return view('home.article.detail',['article'=>$article,'preArt'=>$preArt,'nextArt'=>$nextArt,'comments'=>$comments,'num'=>$num]);
    }

    //文章点赞

    public function diggit($id){
    	//判断用户是否登陆

    	if(!session('user')){
    		return ['status'=>'nologin','msg'=>'你还没有登陆，请先登录，再来点赞'];
    	}

    	//判断 此用户是否已经对此文章进行点赞
    	$ArticleModel = new ArticleModel;

    	$username = session('user');


    	if(!$ArticleModel->checkLike($username,$id)){
    		return ['status'=>'fail','msg'=>'你已经点过了'];
    	}

    	

    	$res = $ArticleModel->insertLike($username,$id);



    	if($res){
    		return ['status'=>'success','msg'=>'点赞成功','num'=>$res];
    	}

    }

    //文章评论

    public function comment(Request $request){

    	//判断用户是否登陆

    	if(!session('user')){
    		return ['status'=>'nologin','msg'=>'你还没有登陆，请先登录，再来点赞'];
    	}

    	//判断验证码是否正确

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


    	$username = session('user');
    	$time = time();
    	$content = trim($request->input('content'));

    	$art_id = $request->input('art_id');

    	$data = ['username'=>$username,'created_at'=>$time,'content'=>$content,'art_id'=>$art_id];

    	$ArticleModel = new ArticleModel;

       $res = $ArticleModel->insertComment($data);

       if($res){
       	 return ['msg'=>'评论成功','status'=>'success'];
       }

    }

    public function search(Request $request){
        $keywords = trim($request->input('keywords'));
        $ArticleModel = new ArticleModel;
        $articles = $ArticleModel->searchArt($keywords);

        return view('home.article.search',['articles'=>$articles]);

    }

   

}

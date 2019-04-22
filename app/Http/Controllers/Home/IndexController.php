<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\ImageModel;
use App\Model\ArticleModel;

class IndexController extends Controller
{
    //

    public function index(){



    	$ImageModel = new ImageModel;
    	$images = $ImageModel->getImagesBySort();

    	//获取文章列表

    	$ArticleModel = new ArticleModel;

    	$articles = $ArticleModel->getIndexArt();

    	return view('home.index',['images'=>$images,'articles'=>$articles]);
    }
}

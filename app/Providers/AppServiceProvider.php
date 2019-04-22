<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use  App\Model\SystemModel;
use View;
use App\Model\ArticleModel;
use App\Model\LinkModel;
use App\Model\CatModel;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //获取网站的设置
        $SystemModel = new SystemModel;
        $sys = $SystemModel->getSys();

        //获取文章的关键词

        $ArticleModel = new ArticleModel;
        $keywords = $ArticleModel->getArticleKey();

        //获取友情连接

        $LinkModel = new LinkModel;
        $links =  $LinkModel->getLinksBySort();

        //获取最新文章
        $newArts = $ArticleModel->getNewArts();

        //获取文章分类

        $CatModel = new CatModel;

        $cats = $CatModel->getCats();



        View::share(['sys'=>$sys,'keywords'=>$keywords,'links'=>$links,'newArts'=>$newArts,'cats'=>$cats]);


    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

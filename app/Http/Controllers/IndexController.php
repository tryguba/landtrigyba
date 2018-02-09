<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Page;
use App\Portfolio;
use App\Service;
use App\People;


class IndexController extends Controller
{
    public function execute (Request $request){

        $pages = Page::all();  /// витягує все з таблиці
        $portfolios = Portfolio::get(array('name','filter','images'));  // витягує з таблиці три поля нейм, фільтр, картинки
        $services = Service::where('id','<',20)->get(); // витягує з таблиці все де Ід < 20
        $peoples = People::take(3)->get(); // нас цікавить тільки три сотрудніка


        $menu = array();
        foreach ($pages as $page){
            $item = array('title' =>$page->name, 'alias'=>$page->alias);
            array_push($menu,$item);
        }

        $item = array('title' =>'Services', 'alias'=>'service');
        array_push($menu,$item);

        $item = array('title' =>'Portfolio', 'alias'=>'Portfolio');
        array_push($menu,$item);

        $item = array('title' =>'Team', 'alias'=>'team');
        array_push($menu,$item);

        $item = array('title' =>'Contact', 'alias'=>'contact');
        array_push($menu,$item);
        //dd($peoples);
        return view('site.index', array(
                                            'menu'=>$menu,
                                            'pages'=>$pages,
                                            'services'=>$services,
                                            'portfolios'=>$portfolios,
                                            'peoples'=>$peoples,
        ));
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Visitor;
use App\Models\Page;
use App\Models\User;

class HomeController extends Controller
{
    public function __construct(){

        $this->middleware('auth');
    }

    public function index(Request $request){
        $visitsCount = 0;
        $onlineCount = 0;
        $pageCount = 0;
        $userCount = 0;
        $select = intval($request->input('days', 30));
        if($select > 120){
            $select = 120;
        }

        //Contagem de visistantes
        $dateSelect = date('Y-m-d H:i:s', strtotime('-'.$select.' days'));
        $visitsCount = Visitor::where('date_acess', '>=', $dateSelect)->count();

        //Contagem de usuários online
        $date = date('Y-m-d H:i:s', strtotime('-5 minutes'));
        $onlineList = Visitor::select('ip')->where('date_acess', '>=', $date)->groupBy('ip')->get();
        $onlineCount = count($onlineList);

        //Contagem de páginas
        $pageCount = Page::count();

        //Contagem de usuários
        $userCount = User::count();

        //Contagem para o pagePie
        $pagePie = [];

        $visitsAll = Visitor::selectRaw('page, count(page) as c')->where('date_acess', '>=', $dateSelect)->groupBy('page')->get();

        foreach($visitsAll as $visit){
            $pagePie[ $visit['page'] ] = intval($visit['c']);
        }
        


        $pageLabels = json_encode( array_keys($pagePie));
        $pageValues = json_encode( array_values($pagePie));

        return view('admin.home', [
            'visitsCount' => $visitsCount,
            'onlineCount' => $onlineCount,
            'pageCount' => $pageCount,
            'userCount' => $userCount,
            'pageLabels' => $pageLabels,
            'pageValues' =>$pageValues,
            'dateInterval' => $select
        ]);
        
    }

    
}

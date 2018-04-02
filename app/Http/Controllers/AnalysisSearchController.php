<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\SitesController as siteController;
use App\Sites;

class AnalysisSearchController extends Controller
{
    public function search(Request $request){
        $newSite = siteController::newSite();
        $oldSites =  Sites::where('nameSite','like','%'.$request->input('search').'%')->where('category_id','<>',0)->orderBy('nameSite')->paginate(5000);
        $search = Sites::where('nameSite','like','%'.$request->input('search').'%')->where('category_id','=',0)->orderBy('nameSite')->paginate(5000);
        $categories = siteController::getCategories();
        return view('sites',['sites'=>$search,'new'=>$newSite,'categories'=>$categories,'old'=>$oldSites,'search'=>$request->input('search')]);
    }
}

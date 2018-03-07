<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\SitesController as siteController;
use App\Sites;

class AnalysisSearchController extends Controller
{
    public function search(Request $request){
        $newSite = siteController::newSite();
        $oldSites = siteController::getCategories();
        $search = Sites::where('nameSite','like','%'.$request->input('search').'%')->orderBy('nameSite')->paginate(5000);
        $categories = siteController::getCategories();
        return view('sites',['sites'=>$search,'new'=>$newSite,'categories'=>$categories,'old'=>$oldSites]);
    }
}

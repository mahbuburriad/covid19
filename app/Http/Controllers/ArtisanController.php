<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Artisan;
use Spatie\Sitemap\SitemapGenerator;

class ArtisanController extends Controller
{
    public function optimize($todo){
        if ($todo == 'optimizeClear'){
            Artisan::call('optimize:clear');
            return 'optimization clear';
        } elseif ($todo == 'cache'){
            Artisan::call('optimize');
            return 'optimization cached successfully';
        } elseif ($todo == 'configClear'){
            Artisan::call('config:clear');
            return "config clear successfully";
        } elseif ($todo == 'configCache') {
            Artisan::call('config:cache');
            return "config cache successfully";
        } elseif ($todo == 'routeCache'){
            Artisan::call('route:cache');
            return "route cache successfully";
        } elseif ($todo == 'routeClear'){
            Artisan::call('route:clear');
            return "route clear successfully";
        } elseif ($todo == 'viewCache'){
            Artisan::call('view:cache');
            return "view cache successfully";
        } elseif ($todo == 'viewClear'){
            Artisan::call('view:clear');
            return "view clear successfully";
        } elseif ($todo = 'cacheClear'){
            Artisan::call('cache:clear');
            return "view clear successfully";
        } else{
            return 'You put wrong information';
        }
    }

    public function sitemap(){
        SitemapGenerator::create('https://covid19.mahbuburriad.com')->writeToFile('sitemap.xml');
        return 'sitemap created';
    }

    public function storagelink(){
        Artisan::call('storage:link');
        return 'sitemap created';
    }
}

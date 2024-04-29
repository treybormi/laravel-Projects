<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Urls;
use Illuminate\Support\Facades\Artisan;

class UrlPing extends Controller
{
    public function schedule(Request $request){
        try {
            $link = new Urls();      
            $link->urls = $request->url;
            switch ($request->expression) {
                case '0':
                    $link->scheduled = "Every minute";
                    break;
                case '1':
                    $link->scheduled = "Every hour";
                    break;
                case '2':
                    $link->scheduled = "Every day";
                    break;
                case '3':
                    $link->scheduled = "Every week";
                    break;
                case '4':
                    $link->scheduled = "Every month";
                    break;
                case '5':
                    $link->scheduled = "Every quarter";
                    break;
                case '6':
                    $link->scheduled = "Every year";
                    break;
            }
            $link->status = false;
            $link->save();
            //Artisan::call('schedule:list');
            //Artisan::call('schedule:run');
            return "Task is scheduled as per request.";
        } catch (\Throwable $th) {
            return $th;
        }
    }

    public function listTask(){
        try {
            $links = Urls::all();
            return $links;
        } catch (\Throwable $th) {
            return $th;
        }
    }
}

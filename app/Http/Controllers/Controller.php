<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;


use Illuminate\Support\Facades\Http;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index()
    {
        // صفحه اصلی
        return view('index');
    }

    public function get($name)
    {
        // دریافت اطلاعات بر اساس سمبل توسط ای جکس
        $response = Http::get('https://api.binance.com/api/v3/ticker/price?symbol='.$name);
        
        if($response->successful())
        {           
            return $response->json();
        }else
        {
            return 404;
        }
    }

    public function all()
    {
        // دریافت تمامی آیتم ها
        $items = Http::get('https://api.binance.com/api/v3/ticker/price');
        $items = $items->json();
        return view('list' , compact('items'));
    }
}

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

    public function latestPrice($symbol)
    {
        // دریافت اطلاعات بر اساس سمبل توسط ای جکس
        $response = Http::get('https://api.binance.com/api/v3/ticker/price?symbol='.$symbol);
        
        if($response->successful())
        {           
            return $response->object();
        }else
        {
            return 404;
        }
    }

    public function allItem()
    {
        // دریافت تمامی آیتم ها
        $items = Http::get('https://api.binance.com/api/v3/ticker/price');
        $items = $items->object();
        // dd($items);
        return view('list' , compact('items'));
    }
}

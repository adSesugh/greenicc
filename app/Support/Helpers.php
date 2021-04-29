<?php

use App\Models\News;
use App\Models\Setting;


if(! function_exists('getSetting')) {
    function getSetting($name)
    {
        return Setting::whereId(1)->pluck($name)->first();
    }
}

if(!function_exists('getFooterNews')) {
    function getFooterNews()
    {
        $latestwo_post = News::inRandomOrder()->limit(2)->latest()->get();

        return $latestwo_post;
    }
}

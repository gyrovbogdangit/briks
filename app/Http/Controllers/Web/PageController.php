<?php

namespace App\Http\Controllers\Web;

use App\Helpers\Seo;
use App\Models\Page;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
    public function index(Page $page)
    {
        $seo = new Seo(
            $page->title,
            $page->description,
            $page->og_title,
            $page->og_description,
            asset('img/logo.webp'),
            route('page', ['page' => $page->slug]),
            'article',
        );

        return view('page')->with(['page' => $page, 'seo' => $seo]);
    }
}

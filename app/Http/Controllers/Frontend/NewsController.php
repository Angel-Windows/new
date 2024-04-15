<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use App\Models\Page;
use App\Models\News;
use Illuminate\View\View;

class NewsController extends BaseController
{
    /**
     * @return Factory|Application|View
     */
    public function index()
    {
        $page = Page::trans()->whereSlug('news')->first();
        $news = News::trans()->latest()->paginate(6);
        return view('frontend.showNews', compact('news', 'page'));
    }

    /**
     * @param $slug
     * @return Factory|Application|View
     */
    public function getNews($slug)
    {
        $page = News::trans()->whereSlug($slug)->firstOrFail();

        return view('frontend.showPage', compact('page'));
    }
}

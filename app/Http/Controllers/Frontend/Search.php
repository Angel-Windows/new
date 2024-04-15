<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Products;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\View\View;

class Search extends BaseController
{
    /**
     * @param  Request  $request
     * @return Factory|Application|View
     */

    public function search(Request $request)
    {
        $search = $request->get('search');

        $page = new Page;
        $page->name = $page->meta_title = trans('cosmetics.search');
        $products = Products::trans()->WhereTranslationLike('name', '%'.$search.'%')->paginate(12);

        $products = Products::refImg($products);

        return view('frontend.showSearchResults', compact('products', 'search', 'page'));
    }
}

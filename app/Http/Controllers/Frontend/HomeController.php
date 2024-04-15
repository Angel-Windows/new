<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Page;
use App\Models\Settings;
use App\Models\Slider;
use App\Models\News;
use App\Models\Category;
use App\Models\Products;
use App\Models\Brands;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\View\View;

class HomeController extends BaseController
{
    /**
     * @return Factory|Application|View
     */
    public function index()
    {
        $page = Page::trans()->whereSlug('/')->first();
        $brands = Brands::trans()->get();
        $news = News::trans()->latest('id')->get();
        $slider = Slider::trans()->get();

        //время смены слайдов
        $slideChangeTime = Settings::first()->delay == 0 ? Settings::first()->delay : Settings::first()->delay * 1000;

        //catBlock 1
        $catBlock1 = Category::trans()->where('show_block_1', 1)->first();
        if ($catBlock1) {
            $child_ids = [];
            $childs = $catBlock1->descendantsAndSelf()->get();
            foreach ($childs as $ch) {
                // id текущей категории и всех вложенных
                $child_ids[] = $ch->id;
            }

            $catBlock1Products = Products::trans()->where('price', '!=', '0,00')->Join('dv_products_categories', 'dv_products.id', '=',
                'dv_products_categories.product_id')
                ->select('dv_products.*')
                ->whereIn('dv_products_categories.category_id', $child_ids)
                ->latest('id')
                ->groupBy('dv_products.id')
                ->get();

            $catBlock1Products = Products::refImg($catBlock1Products) ?? '';

        }


        //catBlock 2
        $catBlock2 = Category::trans()->where('show_block_2', 1)->first();

        if ($catBlock2) {
            $child_ids = [];
            $childs = $catBlock2->descendantsAndSelf()->get();
            foreach ($childs as $ch) {
                // id текущей категории и всех вложенных
                $child_ids[] = $ch->id;
            }

            $catBlock2Products = Products::trans()->where('price', '!=', '0,00')->Join('dv_products_categories', 'dv_products.id', '=',
                'dv_products_categories.product_id')
                ->select('dv_products.*')
                ->whereIn('dv_products_categories.category_id', $child_ids)
                ->groupBy('dv_products.id')
                ->latest('id')
                ->get();

            $catBlock2Products = Products::refImg($catBlock2Products);

        }


        //catBlock 3
        $catBlock3 = Category::trans()->where('show_block_3', 1)->first();

        if ($catBlock3) {
            $child_ids = [];
            $childs = $catBlock3->descendantsAndSelf()->get();
            foreach ($childs as $ch) {
                // id текущей категории и всех вложенных
                $child_ids[] = $ch->id;
            }

            $catBlock3Products = Products::trans()->where('price', '!=', '0,00')->Join('dv_products_categories', 'dv_products.id', '=',
                'dv_products_categories.product_id')
                ->select('dv_products.*')
                ->whereIn('dv_products_categories.category_id', $child_ids)
                ->groupBy('dv_products.id')
                ->latest('id')
                ->get();

            $catBlock3Products = Products::refImg($catBlock3Products);
        }

        return view('frontend.home', compact('page', 'slider', 'brands', 'news',
            'slideChangeTime', 'catBlock1', 'catBlock2', 'catBlock3', 'catBlock1Products', 'catBlock2Products',
            'catBlock3Products'));
    }


}

<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Admin\AdminBaseController;
use App\Models\Brands;
use App\Models\Category;
use App\Http\Requests\BrandsRequest;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use Input;

class AdminBrandsController extends AdminBaseController
{
    public function getIndex()
    {
        $title = 'Бренды';
        $brands_count = Brands::count();
        $brands = Brands::withTranslation()->latest()->paginate(25);
        if( Input::has('search') && Input::get('search') != '' )
            $brands = Brands::where('dv_brands.name', 'like', '%'.Input::get('search').'%' )->paginate(25);
        return view('admin.showBrands', compact(['brands','brands_count', 'title']));
    }


    public function postIndex( Request $request ) 
    {
        $ids = $request->get('check');
        // если действие для удаления
        if( $request->get('action') == 'delete' ) {
            // удалим из бд
            Brands::destroy( $ids );
        }
        return redirect()->back();
    }


    public function getAdd()
    {
        $post = new Brands;
        $post->image = '';

        $title = 'Добавить бренд';
        return view('admin.editBrandsPost', compact(['post', 'title']));
    }


    public function postAdd( BrandsRequest $request )
    {
        $post = Brands::create( $request->except(['image']) );

        if( $image = $request->file('image') )
            Brands::saveImage( $image, $post->id );


        return redirect('master/brands')->with('message', 'Бренд успешно добавлен!');
    }

    /**
     * @param $id
     * @return View
     */

    public function getEdit( $id ): View
    {
        $post = Brands::find($id);
        $title = 'Редактирование бренда';

        return view('admin.editBrandsPost', compact(['post', 'title']));
    }

    /**
     * @param  BrandsRequest  $request
     * @param $id
     * @return Application|RedirectResponse|Redirector
     */

    public function postEdit( BrandsRequest $request, $id )
    {
        $post = Brands::findOrFail($id);
        $post->update( $request->except(['image']) );

        if( $image = $request->file('image') )
            Brands::updateImage( $image, $id );


        return redirect('/master/brands/edit/' . $id)->with('message', 'Бренд успешно обновлен!');
    }
}

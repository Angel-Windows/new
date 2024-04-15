<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use App\Models\Page;
use App\Http\Requests\PageRequest;
use Illuminate\View\View;

class AdminPageController extends AdminBaseController
{
    /**
     * @param $type
     * @param  int  $parent_id
     * @return Factory|Application|View
     */
    public function pagesCategories($type, int $parent_id = 0)
    {

        $pages = json_encode(array_values(Page::select(['id', 'parent_id', 'lft', 'rgt', 'depth', 'name', 'type'])
            ->withTranslation()
            ->where('type', '=', $type)
            ->get()
            ->toHierarchy()
            ->toArray()));
        $types = [
            'main' => 'Основные страницы', 'other' => 'Другие страницы', 'bay' => 'Страницы покупателям',
            'catalog' => 'Страницы "КАТАЛОГ"'
        ];
        $title = $types[$type];

        return view('admin.showPages', compact(['pages', 'type', 'parent_id', 'title']));
    }


    public function editPost($type, $id)
    {
        $post = Page::find($id);
        $title = 'Редактирование страницы';
        return view('admin.editPagePost', compact(['title', 'post', 'type']));
    }


    public function postEdit(PageRequest $request, $type, $id)
    {
//        dd($request->all());

        Page::find($id)->update($request->all());
        return redirect('/master/pages/'.$type.'/edit/'.$id)->with('success', 'Страница успешно обновлена!');
    }


    public function getAdd($type)
    {
        $post = new Page;
        $title = 'Создание страницы';
        return view('admin.editPagePost', compact(['post', 'title', 'type']));
    }

    public function postAdd(PageRequest $request, $type)
    {
        $insert = array_merge($request->all());
        Page::create($insert);
        return redirect('/master/pages/'.$type)->with('success', 'Страница успешно добавлена!');
    }


    public function actionPost(Request $request)
    {

        $ids = $request->get('check');

        // если действие для удаления
        if ($request->get('action') == 'delete') {
            // удалим из бд
            Page::destroy($ids);
        } elseif ($request->get('action') == 'rebuild') {
            Page::rebuildTree($request->get('data'));
            return 'rebuilded';
        }

        return redirect()->back();
    }
}

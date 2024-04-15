<?php namespace App\Http\Controllers\Admin;

use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\News;
use App\Http\Requests\NewsRequest;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class AdminNewsController extends AdminBaseController
{
    /**
     * @return View
     */
    public function getIndex(): View
    {
        $title = 'Новости';
        $news_count = News::count();
        $news = News::withTranslation()->latest()->paginate();
        return view('admin.showNews', compact('news', 'news_count', 'title'));
    }


    public function postIndex(Request $request): RedirectResponse
    {

        $ids = $request->get('check');
        // если действие для удаления
        if ($request->get('action') == 'delete') {
            // удалим из бд
            News::destroy($ids);
        }
        return redirect()->back();
    }

    /**
     * @return Factory|Application|View
     */
    public function getAdd()
    {
        $post = new News;
        $title = 'Создание Новостей';
        $post->image = '';
        return view('admin.editNewsPost', compact(['post', 'title']));
    }

    /**
     * @param  NewsRequest  $request
     * @return Application|RedirectResponse|Redirector
     */
    public function postAdd(NewsRequest $request)
    {
        $post = News::create($request->except('image'));

        if ($image = $request->file('image')) {
            News::saveImage($image, $post->id);
        }

        return redirect('master/news')->with('message', 'Новость успешно добавлена!');
    }


    public function getEdit($id)
    {
        $post = News::find($id);
        $title = 'Редактирование Новостей';
        return view('admin.editNewsPost', compact(['post', 'title']));
    }

    /**
     * @param  NewsRequest  $request
     * @param $id
     * @return Application|RedirectResponse|Redirector
     */

    public function postEdit(NewsRequest $request, $id)
    {
//        dd($request->all());
        $news = News::findOrFail($id);
        $news->update($request->except('image'));

        if ($image = $request->file('image')) {
            News::updateImage($image, $id);
        }

        return redirect('/master/news/edit/'.$id)->with('message', 'Новость успешно обновлена!');
    }
}
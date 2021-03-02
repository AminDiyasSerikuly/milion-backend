<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends BaseController
{
    public function news()
    {
        $news = News::all()->toArray();
        return $this->sendResponse($news);
    }

    public function newsById(Request $request)
    {
        $oneNews = News::find($request->id);
        if ($oneNews) {
            $oneNews = $oneNews->toArray();
            return $this->sendResponse($oneNews);
        }
        return $this->sendError('По указанному id новость не найдено !!');


    }
}

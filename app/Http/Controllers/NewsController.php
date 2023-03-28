<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Contracts\View\View;

class NewsController extends Controller
{
    public function index(): View
    {
        $news = News::query()->latest()->paginate();

        return view('news.index', compact('news'));
    }

    public function show(News $news): View
    {
        return view('news.show', compact('news'));
    }
}

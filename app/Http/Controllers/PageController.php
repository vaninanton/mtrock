<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Contracts\View\View as ViewContract;
use Illuminate\Support\Facades\View;

class PageController extends Controller
{
    public function __invoke(Page $page): ViewContract
    {
        return View::first(['page.'.$page->slug, 'page.index'], compact('page'));
    }
}

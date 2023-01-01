<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Response;

class PageController extends Controller
{
    public function __invoke(Page $page): Response
    {
        return response()->view('page', compact('page'));
    }
}

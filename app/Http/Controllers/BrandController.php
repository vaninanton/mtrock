<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Contracts\View\View;

class BrandController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        $brands = Brand::query()->get();

        return view('brand.index', compact('brands'));
    }

    /**
     * @param  Brand  $brand
     * @return View
     */
    public function show(Brand $brand): View
    {
        $brand->load([
            'products' => fn ($query) => $query->forProductCard()->ordered()->get(),
        ]);

        return view('brand.show', compact('brand'));
    }
}

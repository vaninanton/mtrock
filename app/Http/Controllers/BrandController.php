<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Response;

class BrandController extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function index(): Response
    {
        $brands = Brand::query()->get();

        return response()->view('brand.index', compact('brands'));
    }

    /**
     * @param  Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand): Response
    {
        $brand->load([
            'products' => fn ($query) => $query->with(['brand', 'category'])->ordered()->get()
        ]);

        return response()->view('brand.show', compact('brand'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\RedirectResponse;

class RedirectController extends Controller
{
    public function subCategoryExists(string $category, string $subCategory): RedirectResponse
    {
        return redirect()->route('category', ['category' => $subCategory], 301);
    }

    public function subCategory(string $category, string $subcategory): RedirectResponse
    {
        return redirect()->route('category', $category, 301);
    }

    public function product(string $category, Product $product): RedirectResponse
    {
        return redirect()->route('product', $product, 301);
    }

    public function subProduct(string $category, string $subcategory, Product $product): RedirectResponse
    {
        return redirect()->route('product', $product, 301);
    }
}

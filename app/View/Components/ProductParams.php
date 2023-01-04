<?php

namespace App\View\Components;

use App\Models\Product;
use Illuminate\View\Component;

class ProductParams extends Component
{
    /**
     * The properties / methods that should not be exposed to the component template.
     *
     * @var array
     */
    protected $except = ['product'];

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(public Product $product)
    {
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $paramsParsed = $this->product->paramsParsed;

        return view('components.product-params', [
            'paramsParsed' => $paramsParsed,
        ]);
    }
}

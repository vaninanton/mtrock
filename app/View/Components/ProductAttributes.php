<?php

namespace App\View\Components;

use App\Models\Product;
use Illuminate\View\Component;

class ProductAttributes extends Component
{
    public $values = [];

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(public Product $product)
    {
        $attributeGroups = $product->attributes->groupBy('title');
        foreach ($attributeGroups as $attributeGroup) {
            $key = $attributeGroup->first()->title;
            $value = [];
            foreach ($attributeGroup as $attribute) {
                $value[] = $attribute->pivot->attributeOption?->value ?? $attribute->pivot->value;
            }
            $this->values[$key] = join(', ', $value);
            if ($this->values[$key] === 'Зима, Весна, Лето, Осень') {
                $this->values[$key] = 'Всесезонная';
            } elseif ($this->values[$key] === 'Весна, Лето, Осень') {
                $this->values[$key] = 'Весна-осень';
            }
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.product-attributes');
    }
}

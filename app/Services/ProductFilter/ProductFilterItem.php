<?php

declare(strict_types=1);

namespace App\Services\ProductFilter;

use Illuminate\Support\Collection;

class ProductFilterItem
{
    public string $title;

    public string $name;

    public string $param;

    public Collection $options;

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function setParam(string $param): self
    {
        $this->param = $param;

        return $this;
    }

    public function setOptions(Collection $options): self
    {
        $this->options = $options;

        return $this;
    }
}

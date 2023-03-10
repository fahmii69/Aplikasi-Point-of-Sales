<?php

namespace App\View\Components\Product;

use Illuminate\View\Component;

class AddAttribute extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(public string $attribute)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.product.add-attribute');
    }
}

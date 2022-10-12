<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Interfaces\BrandRepositoryInterface;

class Brand extends Component
{
    private $brandRepository;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(BrandRepositoryInterface $brandRepository)
    {
        $this->brandRepository = $brandRepository;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.brand', ['brands' => $this->brandRepository->getAllBrands()]);
    }
}

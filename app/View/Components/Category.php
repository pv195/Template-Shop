<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Interfaces\CategoryRepositoryInterface;

class Category extends Component
{
    private $categoryRepository;
    public $type;
    
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(CategoryRepositoryInterface $categoryRepository, $type = null)
    {
        $this->categoryRepository = $categoryRepository;
        $this->type = $type;
    }

    /**
     * Get type class
     *
     * @return void
     */
    public function typeClass()
    {
        if ($this->type == 'categoryProduct') {
            return 'nav-item';
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.category', ['categories' => $this->categoryRepository->getAllCategories()]);
    }
}

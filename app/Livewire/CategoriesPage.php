<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Category -> E-Commerce')]
class CategoriesPage extends Component
{
    public function render()
    {
        return view('livewire.categories-page',[
            'categories'=>Category::where('is_active', 1)->get()
        ]);
    }
}

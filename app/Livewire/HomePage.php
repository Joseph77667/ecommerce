<?php

namespace App\Livewire;

use App\Models\Brand;
use App\Models\Category;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('E-Commerce->Home')]
class HomePage extends Component
{
    public function render()
    {
        return view('livewire.home-page',[
            'brands'=>Brand::where('is_active', 1)->get(),
            'categories'=>Category::where('is_active', 1)->get()
        ]);
    }
}

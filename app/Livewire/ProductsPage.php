<?php

namespace App\Livewire;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Product->E-Commerce')]
class ProductsPage extends Component
{
    use WithPagination;

    #[Url]
    public $selected_categories=[];

    #[Url]
    public $selected_brands=[];

    #[Url]
    public $featured=[];

    #[Url]
    public $on_sale=[];

    #[Url]
    public $price_range = 200000;
    public function render()
    {
        $product = Product::query()->where('is_active', 1);
        
        if (!empty($this->selected_categories)) {
            $product->whereIn('category_id', $this->selected_categories);
        }
        if (!empty($this->selected_brands)) {
            $product->whereIn('brand_id', $this->selected_brands);
        }
        if (!empty($this->featured)) {
            $product->where('is_featured', 1);
        }
        if (!empty($this->on_sale)) {
            $product->where('on_sale', 1);
        }
        // if ($this->price_range) {
        //     $product->whereBetween('price', [1000, $this->price_range]);
        // }
        
        return view('livewire.products-page',[
            'products' => $product->paginate(9),
            'brands' => Brand::where('is_active', 1)->get(['id', 'name', 'slug']),
            'categories' => Category::where('is_active', 1)->get(['id', 'name', 'slug']),
        ]);
    }
}

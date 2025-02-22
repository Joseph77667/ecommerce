<?php

namespace App\Livewire;

use App\Helpers\CartManagement;
use App\Livewire\Partials\Navbar;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;

#[Title('Product->E-Commerce')]
class ProductsPage extends Component
{
    use WithPagination;
    use LivewireAlert;

    #[Url]
    public $selected_categories=[];

    #[Url]
    public $selected_brands=[];

    #[Url]
    public $featured=[];

    #[Url]
    public $on_sale=[];
    #[Url]
    public $sort="latest";

    #[Url]
    public $price_range = 200000;

    //add product to cart method
    public function addToCart($product_id){
        $total_count = CartManagement::addItemToCart($product_id);

        $this->dispatch('update-cart-count', total_count: $total_count)->to(Navbar::class);

        $this->alert('info', 'Product Added To The Cart Successfully!', [
            'position' => 'bottom-end',
            'timer' => 3000,
            'toast' => true
        ]);
    }
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
        if($this->sort == 'latest'){
            $product->latest();
        }
        if($this->sort == 'price'){
            $product->orderBy('price');
        }
        
        return view('livewire.products-page',[
            'products' => $product->paginate(9),
            'brands' => Brand::where('is_active', 1)->get(['id', 'name', 'slug']),
            'categories' => Category::where('is_active', 1)->get(['id', 'name', 'slug']),
        ]);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryProductController extends Controller
{
    private $product, $category;

    public function __construct(Product $product, Category $category){
        $this->category = $category; 
        $this->product = $product; 
    }

    public function categories($idProduct)
    {
        $product = $this->product->find($idProduct);

        if(!$product)
            return redirect()->back();
        
        $categories = $product->categories()->paginate();

        return view('admin.pages.products.categories.categories', compact('product', 'categories'));
    }

    public function productsAvailable(Request $request, $idCategory)
    {
        if(!$category = $this->category->find($idCategory))
            return redirect()->back();
        

        $filters = $request->except('_token');

        $products = $category->productsAvailable($request->filter);

        return view('admin.pages.categories.products.available', compact('category', 'products', 'filters'));
    }

    public function products($idCategory)
    {
        $category = $this->category->find($idCategory);

        if(!$category)
            return redirect()->back();
        
        $products = $category->products()->paginate();

        return view('admin.pages.categories.products.products', compact('products', 'category'));
    }

    public function attachProductsCategory(Request $request, $idCategory)
    {
        if(!$category = $this->category->find($idCategory))
            return redirect()->back();
        
        if (!$request->products || count($request->products) == 0) {
            return redirect()
                    ->back()
                    ->with('info', 'Escolha pelo menos uma permissão');
        }

        $category->products()->attach($request->products);

        return redirect()->route('categories.products.index', $idCategory);
    }

    public function detachProductsCategory($idCategory, $idProduct)
    {
        $product = $this->product->find($idProduct);
        $category = $this->category->find($idCategory);

        if(!$category || !$product)
            return redirect()->back();
        
        $category->products()->detach($product);

        return redirect()->route('categories.products.index', $idCategory);
    }
}

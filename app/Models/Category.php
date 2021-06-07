<?php

namespace App\Models;

use App\Tenant\Traits\TenantTrait;
use App\Tenant\Observers\TenantObserver;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use TenantTrait;

    protected $fillable = ['name', 'url', 'description'];

    public function productsAvailable( $filter = null)
    {
        $products = Product::whereNotIn ('products.id', function ($query)
        {
            $query->select('category_product.product_id');
            $query->from('category_product');
            $query->whereRaw("category_product.category_id={$this->id}");

        })->where(function ($queryFilter) use ($filter)
        {
            if($filter)
                $queryFilter->where('products.title', 'LIKE', "%{$filter}%");
        })
          ->paginate();

        return $products;
    }

    public function products()
    {  
        return $this->belongsToMany(Product::class);
    }

    public function search($filter = null)
    {
        $results = $this->orWhere('name', 'LIKE', "%$filter%")
                        ->orWhere('description', 'LIKE', "%$filter%")
                        ->paginate();
        return $results;
    }
}

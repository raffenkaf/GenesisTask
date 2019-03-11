<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProduct;
use App\Http\Requests\UpdateProduct;
use App\Product;

class ProductController extends Controller
{
    public function index()
    {
        return Product::select('id', 'name', 'description', 'price')
            ->paginate(15);
    }

    public function store(StoreProduct $request): Product
    {
        $product = new Product($request->all());
        $product->price = $request->get('price');
        $product->discount = $request->get('discount');
        $product->save();

        return $product;
    }

    public function show(int $id): Product
    {
        return Product::findOrFail($id);
    }

    public function update(UpdateProduct $request, int $id): Product
    {
        /**
         * @var $product Product
         */
        $product = Product::findOrFail($id);
        $product->update($request->all());

        return $product;
    }
}

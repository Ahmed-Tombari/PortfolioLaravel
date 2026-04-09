<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductService
{
    public function getAllProducts()
    {
        return Product::with('category')->latest()->get();
    }
    
    public function getProductsByCategory($categoryId)
    {
        return Product::where('category_id', $categoryId)->latest()->get();
    }

    public function getFeaturedProducts($limit = 6)
    {
        return Product::with('category')->latest()->take($limit)->get();
    }

    public function createProduct(array $data, $imageFile = null)
    {
        $data['slug'] = Str::slug($data['title']);

        if ($imageFile) {
            $data['image'] = $imageFile->store('product', 'public');
        }

        return Product::create($data);
    }

    public function updateProduct(Product $product, array $data, $imageFile = null)
    {
        $data['slug'] = Str::slug($data['title']);

        if ($imageFile) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $data['image'] = $imageFile->store('product', 'public');
        }

        return $product->update($data);
    }

    public function deleteProduct(Product $product)
    {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        return $product->delete();
    }
}

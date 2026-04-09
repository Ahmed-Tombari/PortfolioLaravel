<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Support\Str;

class CategoryService
{
    public function getAllCategories()
    {
        return Category::all();
    }

    public function createCategory(array $data)
    {
        $data['slug'] = Str::slug($data['name']);
        return Category::create($data);
    }

    public function updateCategory(Category $category, array $data)
    {
        $data['slug'] = Str::slug($data['name']);
        return $category->update($data);
    }

    public function deleteCategory(Category $category)
    {
        return $category->delete();
    }
}

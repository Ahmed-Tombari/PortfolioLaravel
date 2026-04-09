<?php

namespace App\Http\Controllers;

use App\Services\HeroService;
use App\Services\CategoryService;
use App\Services\ProductService;
use App\Http\Resources\HeroResource;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    protected $heroService;
    protected $categoryService;
    protected $productService;

    public function __construct(HeroService $heroService, CategoryService $categoryService, ProductService $productService)
    {
        $this->heroService = $heroService;
        $this->categoryService = $categoryService;
        $this->productService = $productService;
    }

    public function index()
    {
        $hero = $this->heroService->getHero();
        $categories = $this->categoryService->getAllCategories();
        $products = $this->productService->getFeaturedProducts(6);

        return view('front.page.index', [
            'hero' => $hero ? new HeroResource($hero) : null,
            'categories' => CategoryResource::collection($categories),
            'products' => ProductResource::collection($products)
        ]);
    }

    public function about()
    {
        return view('front.page.about');
    }

    public function services()
    {
        return view('front.page.services');
    }

    public function portfolio()
    {
        $categories = $this->categoryService->getAllCategories();
        $products = $this->productService->getAllProducts();

        return view('front.page.portfolio', [
            'categories' => CategoryResource::collection($categories),
            'products' => ProductResource::collection($products)
        ]);
    }

    public function contact()
    {
        return view('front.page.contact');
    }

    public function category($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $categories = $this->categoryService->getAllCategories();
        $products = $this->productService->getProductsByCategory($category->id);

        return view('front.page.portfolio', [
            'category' => new CategoryResource($category),
            'categories' => CategoryResource::collection($categories),
            'products' => ProductResource::collection($products)
        ]);
    }
}

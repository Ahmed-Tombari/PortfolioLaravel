<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hero;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HeroController extends Controller
{
    protected $heroService;

    public function __construct(\App\Services\HeroService $heroService)
    {
        $this->heroService = $heroService;
    }

    public function index()
    {
        $hero = $this->heroService->getHero();
        return view('admin.hero.index', compact('hero'));
    }

    public function edit(Hero $hero)
    {
        return view('admin.hero.edit', compact('hero'));
    }

    public function update(Request $request, Hero $hero)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'btn_text' => 'nullable|string|max:255',
            'btn_url' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $data = $request->only(['title', 'subtitle', 'btn_text', 'btn_url']);
        
        $this->heroService->updateHero($hero, $data, $request->file('image'));

        return redirect()->route('admin.hero.index')->with('success', 'Hero section updated successfully.');
    }

    public function store(Request $request)
    {
        $hero = $this->heroService->getHero();
        if ($hero) {
            return $this->update($request, $hero);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048',
        ]);

        $this->heroService->createHero($request->except('image'), $request->file('image'));

        return redirect()->route('admin.hero.index')->with('success', 'Hero section created successfully.');
    }
}

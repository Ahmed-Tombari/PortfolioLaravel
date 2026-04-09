<?php

namespace App\Services;

use App\Models\Hero;
use Illuminate\Support\Facades\Storage;

class HeroService
{
    public function getHero()
    {
        return Hero::first(); // Assuming we only have one hero
    }

    public function createHero(array $data, $imageFile = null)
    {
        if ($imageFile) {
            $data['image'] = $imageFile->store('hero', 'public');
        }

        return Hero::create($data);
    }

    public function updateHero(Hero $hero, array $data, $imageFile = null)
    {
        if ($imageFile) {
            if ($hero->image) {
                Storage::disk('public')->delete($hero->image);
            }
            $data['image'] = $imageFile->store('hero', 'public');
        }

        return $hero->update($data);
    }

    public function deleteHero(Hero $hero)
    {
        if ($hero->image) {
            Storage::disk('public')->delete($hero->image);
        }
        return $hero->delete();
    }
}

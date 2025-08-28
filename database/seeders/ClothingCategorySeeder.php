<?php

namespace Database\Seeders;

use App\Models\ClothingCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClothingCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categorie = [
            'Magliette',
            'Pantaloni',
            'Scarpe',
            'Giacche',
            'Accessori',
        ];
        foreach ($categorie as $nomeCategoria) {
            ClothingCategory::create([
                'name' => $nomeCategoria
            ]);
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categorie = [
            'Calcio',
            'Basket',
            'Ciclismo',
            'Tennis',
            'Nuoto',
            'Pallavolo',
            'Pugilato',
            'Casual',
        ];
        foreach ($categorie as $nomeCategoria) {
            Category::create([
                'name' => $nomeCategoria
            ]);
        }
    }
}

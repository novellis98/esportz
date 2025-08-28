<?php

namespace Database\Seeders;

use App\Models\PersonCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PersonCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categorie = [
            'Uomo',
            'Donna',
            'Bambino',
        ];
        foreach ($categorie as $nomeCategoria) {
            PersonCategory::create([
                'name' => $nomeCategoria
            ]);
        }
    }
}

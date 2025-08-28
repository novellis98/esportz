<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $articles = [
            [
                'name' => 'T-shirt basic',
                'description' => 'Una t-shirt semplice, comoda per tutti i giorni.',
                'img' => 'images/foto1.jpg',
                'price' => 19.99,
                'material' => 'Cotone',
                'color' => 'Bianco',
                'stock' => 50,
                'category_id' => 8,
                'clothing_category_id' => 1,
                'person_category_id' => 2,
            ],
            [
                'name' => 'Jeans slim fit',
                'description' => 'Jeans modello slim fit, adatti per un look casual.',
                'img' => 'images/foto2.jpg',
                'price' => 49.99,
                'material' => 'Denim',
                'color' => 'Blu',
                'stock' => 90,
                'category_id' => 8,
                'clothing_category_id' => 2,
                'person_category_id' => 2,
            ],
            [
                'name' => 'Giacca in pelle',
                'description' => 'Giacca in pelle per un look elegante e sofisticato.',
                'img' => 'images/foto3.jpg',
                'price' => 129.99,
                'material' => 'Pelle',
                'color' => 'Nero',
                'stock' => 70,
                'category_id' => 8,
                'clothing_category_id' => 4,
                'person_category_id' => 2,
            ],
            [
                'name' => 'Felpa con cappuccio',
                'description' => 'Felpa con cappuccio, ideale per le giornate fredde.',
                'img' => 'images/foto4.jpg',
                'price' => 39.99,
                'material' => 'Poliestere',
                'color' => 'Arancione',
                'stock' => 100,
                'category_id' => 1,
                'clothing_category_id' => 1,
                'person_category_id' => 1,
            ],
            [
                'name' => 'Scarpe da ginnastica',
                'description' => 'Scarpe sportive per ogni occasione.',
                'img' => 'images/foto5.jpg',
                'price' => 59.99,
                'material' => 'Tessuto sintetico',
                'color' => 'Rosso',
                'stock' => 80,
                'category_id' => 3,
                'clothing_category_id' => 3,
                'person_category_id' => 2,
            ],
            [
                'name' => 'Borsa in pelle',
                'description' => 'Borsa elegante in pelle per un look sofisticato.',
                'img' => 'images/foto7.jpg',
                'price' => 29.99,
                'material' => 'Plastica',
                'color' => 'Nero',
                'stock' => 40,
                'category_id' => 8,
                'clothing_category_id' => 5,
                'person_category_id' => 2,
            ],
            [
                'name' => 'Cappello invernale',
                'description' => 'Cappello caldo per l’inverno.',
                'img' => 'images/foto8.jpg',
                'price' => 15.99,
                'material' => 'Lana',
                'color' => 'Blu',
                'stock' => 200,
                'category_id' => 8,
                'clothing_category_id' => 5,
                'person_category_id' => 3,
            ],
            [
                'name' => 'Portafoglio in pelle',
                'description' => 'Portafoglio elegante in pelle con scomparti per carte e banconote.',
                'img' => 'images/foto9.jpg',
                'price' => 49.99,
                'material' => 'Pelle',
                'color' => 'Marrone',
                'stock' => 150,
                'category_id' => 8,
                'clothing_category_id' => 5,
                'person_category_id' => 1,
            ],
            [
                'name' => 'T-shirt',
                'description' => 'T-shirt con logo stampato sul davanti.',
                'img' => 'images/foto10.jpg',
                'price' => 22.99,
                'material' => 'Cotone',
                'color' => 'Nero',
                'stock' => 60,
                'category_id' => 1,
                'clothing_category_id' => 1,
                'person_category_id' => 3,
            ],
        ];
        foreach ($articles as $article) {
            Article::create([
                'name' => $article['name'],
                'description' => $article['description'],
                'img' => $article['img'],
                'price' => $article['price'],
                'material' => $article['material'],
                'color' => $article['color'],
                'stock' => $article['stock'],
                'category_id' => $article['category_id'],
                'clothing_category_id' => $article['clothing_category_id'],
                'person_category_id' => $article['person_category_id'],
            ]);
        }
    }
}

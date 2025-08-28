<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleRequest;
use App\Models\Article;
use App\Models\Category;
use App\Models\ClothingCategory;
use App\Models\PersonCategory;
use App\Models\Review;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $articles = Article::all();
        // $customRoute = 'articles.show';
        // return view('articles.index', compact('articles', 'customRoute'));
        return view('articles.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $clothingCategories = ClothingCategory::all();
        $personCategories = PersonCategory::all();
        return view('articles.create', compact('categories', 'clothingCategories', 'personCategories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ArticleRequest $request)
    {

        // dd($request->all());
        Article::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'img' => $request->hasFile('img') ? $request->file('img')->store('images', 'public') : 'no_image.png',
            'material' => $request->material,
            'color' => $request->color,
            'stock' => $request->stock,
            'category_id' => $request->category_id,
            'clothing_category_id' => $request->clothing_category_id,
            'person_category_id' => $request->person_category_id,
        ]);
        return redirect()->route('articles.index')->with('message', 'Articolo creato con successo!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $article = Article::find($id);
        $reviews = Review::where('article_id', $id)->get();
        // $articleWithRatings = $article->map(function ($beer) {
        //     $averageRating = $beer->reviews->avg('rating');
        //     $beer->averageRating = $averageRating;
        //     return $beer;
        // });

        return view('articles.show', compact('article', 'reviews'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        $categories = Category::all();
        $clothingCategories = ClothingCategory::all();
        $personCategories = PersonCategory::all();

        return view('articles.edit', compact('article', 'categories', 'clothingCategories', 'personCategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ArticleRequest $request, Article $article)
    {
        // dd($request->all());
        // Se l'immagine è stata cambiata, elimina la vecchia immagine (se non è 'no_image.png')
        if ($request->hasFile('img') && $article->img !== 'no_image.png') {
            Storage::disk('public')->delete($article->img);
        }
        $article->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'img' => $request->hasFile('img') ? $request->file('img')->store('images', 'public') : $article->img,
            'material' => $request->material,
            'color' => $request->color,
            'stock' => $request->stock,
            'category_id' => $request->category_id,
            'clothing_category_id' => $request->clothing_category_id,
            'person_category_id' => $request->person_category_id,
        ]);

        return redirect()->route('articles.index')->with('message', 'Articolo modificato con successo!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        try {
            // Se l'articolo ha un'immagine diversa da "no_image.png", la eliminiamo
            if ($article->img && $article->img !== 'no_image.png') {
                Storage::disk('public')->delete($article->img);
            }

            $article->delete();
            return redirect()->route('articles.index')->with('message', 'Articolo eliminato con successo!');
        } catch (Exception $e) {
            return redirect()->route('articles.index')->with('error', 'Errore durante l\'eliminazione dell\'articolo.');
        }
    }
}

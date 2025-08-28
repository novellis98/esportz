<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Article $article)
    {
        $reviews = Review::where('article_id', $article->id)->get();
        return view('reviews.index', compact('reviews'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Article $article)
    {
        $reviews = Review::where('article_id', $article->id)->get();
        return view('reviews.create', compact('article', 'reviews'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (auth()->user()->reviews->where('article_id', $request->article_id)->count() > 0) {
            return redirect()->route('articles.show', $request->article_id)->with('message', 'Hai già recensito questo articolo!');
        }
        Review::create([
            'article_id' => $request->article_id,
            'user_id' => auth()->user()->id,
            'body' => $request->body,
            'rating' => $request->rating,
        ]);
        return redirect()->route('articles.show', $request->article_id)->with('message', 'Recensione creata con successo!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Review $review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Review $review)
    {
        $article = $review->article; // Recupera l'articolo associato alla recensione
        $reviews = Review::where('article_id', $article->id)->get();
        // $reviews = $article->reviews; // Recupera tutte le recensioni dell'articolo
        return view('reviews.edit', compact('reviews', 'review', 'article'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Review $review)
    {
        $review->update([
            'article_id' => $request->article_id,
            'user_id' => auth()->user()->id,
            'body' => $request->body,
            'rating' => $request->rating,
        ]);
        return redirect()->route('articles.show', $review->article->id)->with('message', 'Recensione aggiornata con successo!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {
        $articleId = $review->article->id;
        $review->delete();
        if (auth()->user()->role == 'admin') {
            // Se l'utente è admin, reindirizza alla pagina delle recensioni admin
            return redirect()->route('reviews.admin')->with('message', 'Recensione cancellata con successo!');
        }
        return redirect()->route('articles.show', $articleId)->with('message', 'Recensione cancellata con successo!');
    }
    public function adminReviews()
    {
        $reviews = Review::latest()->paginate(10);
        return view('reviews.admin', compact('reviews'));
    }
}

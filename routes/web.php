<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;

// Rotte generali
Route::get('/', [PublicController::class, 'homepage'])->name('homepage');
Route::get('/contacts', [PublicController::class, 'contattaci'])->name('contattaci');
Route::post('/contact-us', [PublicController::class, 'contactUs'])->name('contactUs');
Route::get('recover-password', [PublicController::class, 'recoverPassword'])->name('recover-password');
// Rotte per gli utenti autenticati
Route::middleware('auth')->group(function () {
    Route::get('/order/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
    Route::get('/profile/edit', [PublicController::class, 'userEdit'])->name('profile.edit');
    // Rotte specifiche per user
    Route::middleware('role:user')->group(function () {
        Route::get('/checkout', [OrderController::class, 'index'])->name('orders.index');
        Route::post('/checkout', [OrderController::class, 'store'])->name('orders.store');
        Route::get('/user-orders', [OrderController::class, 'userOrders'])->name('orders.user-orders');
        Route::get('/articles/{article}/reviews/create', [ReviewController::class, 'create'])->name('reviews.create');
        Route::get('/reviews/edit/{review}', [ReviewController::class, 'edit'])->name('reviews.edit');

        Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
        Route::put('/reviews/{review}', [ReviewController::class, 'update'])->name('reviews.update');
    });

    // Rotte specifiche per admin

    Route::middleware('role:admin')->group(function () {
        Route::get('/admin', [OrderController::class, 'adminOrders'])->name('dashboard');
        Route::get('/articles/create', [ArticleController::class, 'create'])->name('articles.create');
        Route::post('/articles/create', [ArticleController::class, 'store'])->name('articles.store');
        Route::get('/articles/edit/{article}', [ArticleController::class, 'edit'])->name('articles.edit');
        Route::put('/articles/{article}', [ArticleController::class, 'update'])->name('articles.update');
        Route::delete('/articles/{article}', [ArticleController::class, 'destroy'])->name('articles.destroy');
        Route::get('/earning', [PublicController::class, 'earnings'])->name('earnings');
        Route::get('/reviews/admin', [ReviewController::class, 'adminReviews'])->name('reviews.admin');
    });

    // Route::get('/question', function () {


    //     $result = OpenAI::chat()->create([
    //         'model' => 'gpt-3.5-turbo',
    //         'messages' => [
    //             ['role' => 'user', 'content' => 'ciao sono umberto oggi facciamo tanto coding!'],
    //         ],
    //     ]);

    //     echo $result->choices[0]->message->content; // Should output: "Hello! How can I assist you today?";
    // });
});
// Route per gli articoli
Route::get('/articles',  [ArticleController::class, 'index'])->name('articles.index');
Route::get('/articles/{id}', [ArticleController::class, 'show'])->name('articles.show');

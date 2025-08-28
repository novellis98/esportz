<div class="accordion mt-5  " id="accordionReview">
    @if (auth()->check() &&
            auth()->user()->role == 'user' &&
            auth()->user()->orders()->whereHas('orderItems', function ($query) use ($article) {
                    $query->where('article_id', $article->id);
                })->exists())
        @php
            $reviewed = auth()->user()->reviews()->where('article_id', $article->id)->exists();
        @endphp

        @if ($reviewed)
            <!-- Messaggio se l'utente ha acquistato e recensito l'articolo -->
            <div class="d-flex justify-content-center flex-column align-items-center my-2">
                <p>Hai già acquistato e recensito questo articolo</p>
            </div>
        @else
            <!-- Messaggio se l'utente ha solo acquistato ma non ha recensito -->
            @if (request()->routeIs('articles.show'))
                <div class="d-flex justify-content-center flex-column align-items-center my-2">
                    <p>Hai già acquistato questo articolo, lascia una recensione</p>
                    <a href="{{ route('reviews.create', ['article' => $article]) }}" class="btn btn-custom">aggiungi
                        recensione</a>
                </div>
            @endif
        @endif
    @endif

    <div class="accordion-item bg-custom">
        <h2 class="accordion-header ">
            <button class="accordion-button collapsed bg-custom" type="button" data-bs-toggle="collapse"
                data-bs-target="#show-review" aria-expanded="false" aria-controls="collapseOne">
                <div class="d-flex justify-content-between w-100">
                    <p class="m-0"> RECENSIONI</p>
                    <p class="text-warning m-0">
                        @for ($i = 1; $i <= 5; $i++)
                            <i
                                class="bi {{ $i <= $article->average_rating ? 'bi-star-fill' : 'bi-star' }} text-warning"></i>
                        @endfor
                    </p>
                </div>
            </button>
        </h2>
        <div id="show-review" class="accordion-collapse collapse" data-bs-parent="#accordionReview">
            @if ($reviews->isNotEmpty())
                @foreach ($reviews as $review)
                    <div class="accordion-body p-1 d-flex align-content-center flex-column px-4">
                        <div class="d-flex justify-content-between align-items-center w-100">
                            <div>
                                <strong>{{ $review->user->name }}: </strong>
                                <span class="text-warning">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <i
                                            class="bi {{ $i <= $review->rating ? 'bi-star-fill text-warning' : 'bi-star text-warning' }}"></i>
                                    @endfor
                                </span>
                            </div>

                            @if (auth()->check() && auth()->id() === $review->user_id)
                                <div class="d-flex align-items-center">
                                    <!-- Pulsante modifica -->
                                    <a href="{{ route('reviews.edit', ['review' => $review]) }}"
                                        class="text-primary mx-1">
                                        <i class="bi bi-pencil-square text-warning"></i>
                                    </a>

                                    <!-- Pulsante elimina -->
                                    <form action="{{ route('reviews.destroy', $review) }}" method="POST"
                                        onsubmit="return confirm('Sei sicuro di voler eliminare questa recensione?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-link text-danger p-0 border-0">
                                            <i class="bi bi-trash text-danger"></i>
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </div>

                        <p class="m-0" id="review-body">{{ $review->body }}</p>
                    </div>
                @endforeach
            @else
                <div class="accordion-body  p-1 d-flex align-content-center flex-column">
                    <p class="m-0">Non ci sono recensioni per questo articolo</p>
                </div>
            @endif
        </div>
    </div>
</div>

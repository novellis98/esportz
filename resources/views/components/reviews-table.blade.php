<div class="container">
    <h1 class="text-center my-3">Recensioni</h1>
    <div class="row">
        <div class="col-12">
            @if ($reviews->isEmpty())
                <p class="text-center">Nessuna recensione ricevuta</p>
            @else
                <div class="table-responsive">
                    <table class="table table-dark table-striped  ">
                        <thead>
                            <tr>
                                <th scope="col">Utente</th>
                                <th scope="col">Rating</th>
                                <th scope="col">Recensione</th>
                                <th scope="col">Data</th>
                                <th scope="col">Articolo</th>
                                <th scope="col">Azioni</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reviews as $review)
                                <tr>
                                    <td>{{ $review->user->name }}</td>
                                    <td>
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= $review->rating)
                                                <i id="table-star" class="bi bi-star-fill"></i> <!-- Stella piena -->
                                            @else
                                                <i id="table-star" class="bi bi-star"></i> <!-- Stella vuota -->
                                            @endif
                                        @endfor
                                    </td>
                                    <td>{{ $review->body }}</td>
                                    <td>{{ $review->created_at }}</td>
                                    <td>{{ $review->article->name }}</td>
                                    <td> <!-- Pulsante elimina -->
                                        <form action="{{ route('reviews.destroy', $review) }}" method="POST"
                                            onsubmit="return confirm('Sei sicuro di voler eliminare questa recensione?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-link p-0 border-0">
                                                <i id="table-trash" class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <!-- Paginazione -->
                    <div class="d-flex justify-content-center ">
                        <nav>
                            {{ $reviews->links('pagination::bootstrap-4') }}
                        </nav>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

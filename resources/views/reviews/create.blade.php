<x-layout title="aggiungi recensione">
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-6 d-flex flex-column gap-4">
                <h3 class="text-center">Lascia una recensione</h3>
                <!-- Form -->
                <div class="form-container">
                    <form action="{{ route('reviews.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="article_id" value="{{ $article->id }}">

                        <div class="mb-3 d-flex justify-content-center gap-2" style="font-size: 1.5rem">
                            @for ($i = 1; $i <= 5; $i++)
                                <input type="radio" id="star{{ $i }}" name="rating"
                                    value="{{ $i }}" required>
                                <label for="star{{ $i }}" class="star">
                                    <i class="bi bi-star text-warning star-icon"></i>
                                </label>
                            @endfor
                        </div>
                        <script>
                            // Otteniamo tutte le etichette (che contengono le icone delle stelle)
                            const stars = document.querySelectorAll('.star');
                            let selectedRating = -1; // Variabile per tracciare la stella selezionata

                            // Aggiungiamo un evento di hover (mouseenter) per ogni stella
                            stars.forEach((star, index) => {
                                const starIcon = star.querySelector('.star-icon');
                                star.addEventListener('mouseenter', () => {
                                    // Cambiamo l'icona della stella quando ci si passa sopra
                                    for (let i = 0; i <= index; i++) {
                                        stars[i].querySelector('.star-icon').classList.add('bi-star-fill');
                                        stars[i].querySelector('.star-icon').classList.remove('bi-star');
                                    }
                                });

                                // Rimuoviamo l'icona piena quando il mouse esce dalla stella
                                star.addEventListener('mouseleave', () => {
                                    for (let i = 0; i < stars.length; i++) {
                                        if (i <= selectedRating) {
                                            stars[i].querySelector('.star-icon').classList.add('bi-star-fill');
                                            stars[i].querySelector('.star-icon').classList.remove('bi-star');
                                        } else {
                                            stars[i].querySelector('.star-icon').classList.add('bi-star');
                                            stars[i].querySelector('.star-icon').classList.remove('bi-star-fill');
                                        }
                                    }
                                });

                                // Gestiamo l'evento click per "selezionare" la stella
                                star.addEventListener('click', () => {
                                    selectedRating = index; // Aggiorniamo la stella selezionata
                                    for (let j = 0; j < stars.length; j++) {
                                        if (j <= index) {
                                            stars[j].querySelector('.star-icon').classList.add('bi-star-fill');
                                            stars[j].querySelector('.star-icon').classList.remove('bi-star');
                                        } else {
                                            stars[j].querySelector('.star-icon').classList.add('bi-star');
                                            stars[j].querySelector('.star-icon').classList.remove('bi-star-fill');
                                        }
                                    }
                                });
                            });
                        </script>


                        <div class="form-group">
                            <label for="body">Recensione</label>
                            <textarea class="form-control" id="body" name="body" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-custom mt-3">Crea recensione</button>
                    </form>
                </div>

                <!-- Accordion per recensioni -->
                <x-accordion-reviews :article="$article" :reviews="$reviews" />
            </div>
        </div>
    </div>
</x-layout>

<x-layout title="articolo:{{ $article->name }}">
    <div class="container my-5">
        <x-alert />
        <div class="row ">
            <div class="col-12 col-md-6 d-flex gap-2">
                <!-- Colonna per i dettagli dell'articolo -->
                <div class="w-100 card-body d-flex  flex-column justify-content-center align-items-center mt-4"
                    style="height: 30rem">
                    <h5 class="card-title my-2">{{ $article->name }}</h5>
                    <p class="card-text">
                    <div class="mb-3"><strong>Descrizione:</strong> {{ $article->description }}<br>
                        <strong>Prezzo:</strong> €{{ $article->price }}<br>
                        <strong>Materiale:</strong> {{ $article->material }}<br>
                        <strong>Colore:</strong> {{ $article->color }}<br>
                        <strong ">Stock:</strong> {{ $article->stock }}<br></div>
                        
                        <strong>Categoria sport:</strong> {{ $article->category->name }}<br>
                        <strong>Categoria abbigliamento:</strong> {{ $article->clothingCategory->name }}<br>
                        <strong>Categoria personale:</strong> {{ $article->personCategory->name }}<br>
                    </p>
                    <a href="{{ route('articles.index') }}" class="btn btn-custom--sec w-25 mb-5"><i
                            class="bi bi-arrow-left-short"></i></a>
                </div>
                </div>
                <div class="col-12 col-md-6 d-flex gap-2 justify-content-center">
                <div class="mt-5 d-flex flex-column align-items-center" >
                    <img src="{{ Storage::url($article->img) }}" class="img-fluid" alt="{{ $article->name }}" style="height: 20rem">
                    @auth
                                    @if (auth()->user()->role == 'user')
                                <div>
                                    <a id="showCartForm" href="{{ route('articles.index', 'article') }}"
                                        class="btn btn-custom my-5">Aggiungi al carrello</a>
                                </div>
                                @endif
                            @endauth
                    </div>
                </div>
            </div>
            <div id="cartForm" class="d-none my-5">
                <livewire:add-cart :article="$article" />
            </div>
            <x-accordion-reviews :article="$article" :reviews="$reviews" />

        </div>
    </div>
</x-layout>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const showCartButton = document.getElementById('showCartForm');
        const cartForm = document.getElementById('cartForm');
        const submitCart = document.getElementById('submitCart');
        if (showCartButton && cartForm) {
            showCartButton.addEventListener('click', function(event) {
                event.preventDefault();
                cartForm.classList.toggle('d-none');
                showCartButton.innerHTML = cartForm.classList.contains('d-none') ?
                    'Aggiungi al carrello' : 'Annulla';
            });
        }
        submitCart.addEventListener('click', function(event) {
            setTimeout(function() {
                cartForm.classList.add('d-none');
                showCartButton.innerHTML = cartForm.classList.contains('d-none') ?
                    'Aggiungi al carrello' : 'Annulla';
            }, 2000);
        })
    });
</script>

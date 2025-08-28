<div>
    <div class="my-4 p-2">
        <form wire:submit.prevent="filterArticles" class="mb-4">
            <div class="row">
                <!-- Filtro per testo -->
                <div class="col-12 col-md-3 mb-3">
                    <input type="text" wire:model.live="search" class="form-control" placeholder="Cerca per testo">
                </div>

                <!-- Filtro per categoria -->
                <div class="col-12 col-md-3 mb-3">
                    <select wire:model="category" class="form-control">
                        <option value="">Categoria Sport</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Filtro per categoria di abbigliamento -->
                <div class="col-12 col-md-3 mb-3">
                    <select wire:model="clothingCategory" class="form-control">
                        <option value="">Categoria Abbigliamento</option>
                        @foreach ($clothingCategories as $clothingCategory)
                            <option value="{{ $clothingCategory->id }}">
                                {{ $clothingCategory->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Filtro per categoria di persona -->
                <div class="col-12 col-md-3 mb-3">
                    <select wire:model="personCategory" class="form-control">
                        <option value="">Categoria Persona</option>
                        @foreach ($personCategories as $personCategory)
                            <option value="{{ $personCategory->id }}">
                                {{ $personCategory->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <!-- Filtro per prezzo minimo -->
                <div class="col-12 col-md-3 mb-3">
                    <input type="number" wire:model.debounce.500ms="min_price" class="form-control"
                        placeholder="Prezzo minimo">
                </div>

                <!-- Filtro per prezzo massimo -->
                <div class="col-12 col-md-3 mb-3">
                    <input type="number" wire:model.debounce.500ms="max_price" class="form-control"
                        placeholder="Prezzo massimo">
                </div>

                <!-- Filtro per ordinamento -->
                <div class="col-12 col-md-3 mb-3">
                    <select wire:model="sortBy" class="form-control">
                        <option value="">Ordina per</option>
                        <option value="latest">Ultimi articoli aggiunti</option>
                        <option value="price_asc">Prezzo crescente</option>
                        <option value="price_desc">Prezzo decrescente</option>
                    </select>
                </div>

                <!-- Bottone di submit per il filtro -->
                <div class="col-12 d-flex justify-content-center gap-2">
                    <button type="button" wire:click="resetFilters" class="btn btn-custom--sec ">Reset</button>
                    <button type="submit" class="btn btn-custom ">Filtra</button>

                </div>
            </div>
        </form>

    </div>

    {{-- <x-alert /> --}}
    <div wire:loading class="text-center my-3">
        <span class="spinner-border spinner-border-sm"></span> Caricamento...
    </div>
    <!-- Lista articoli -->
    <div class="row justify-content-center justify-content-sm-start">
        @forelse ($articles as $article)
            <div class="col-8 col-sm-6 col-md-4 col-lg-3 mb-4">
                <x-card :item="$article" :customRoute="$customRoute" />
            </div>
        @empty
            <p class="text-center">Nessun articolo trovato.</p>
        @endforelse
    </div>
</div>

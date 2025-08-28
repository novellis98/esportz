<div>
    <div class="card bg-custom" style="cursor: pointer">
        <img src="{{ Storage::url($item->img) }}" class="card-img-top img-fluid" alt="{{ $item->name }}"
            style="height: 18rem">
        <div class="card-body">
            <div class="d-flex justify-content-center align-items-center" style="min-height: 4rem; text-align: center;">
                <h5>{{ $item->name }}</h5>
            </div>

            <div class="d-flex justify-content-center align-items-center py-1">
                <p class="text-warning m-0">
                    @for ($i = 1; $i <= 5; $i++)
                        <i class=" bi {{ $i <= $item->average_rating ? 'bi-star-fill' : 'bi-star' }} text-warning"></i>
                    @endfor
                </p>
            </div>
            <div class="d-flex justify-content-cente  flex-column" style="min-height: 8rem">
                <p class="m-0"><strong>Prezzo:</strong> €{{ $item->price }}</p>
                <p class="m-0"> <strong>Materiale:</strong> {{ $item->material }}</p>
                <p class="m-0"><strong>Colore:</strong> {{ $item->color }}</p>
                <p class="m-0"><strong>Stock:</strong> {{ $item->stock }}</p>
            </div>
            <div class="d-flex justify-content-center ">
                <a href="{{ route($customRoute, ['id' => $item->id]) }}" class="btn btn-custom w-100"
                    aria-label="Vedi {{ $item->name }}">Vedi articolo</a>
            </div>
        </div>
        @if (auth()->check() && auth()->user()->role == 'admin')
            <div class="card-footer">
                <div class="d-flex justify-content-between align-content-center">
                    <a href="{{ route('articles.edit', $item) }}" type="submit" class="btn btn-warning"
                        aria-label="Modifica{{ $item->name }} "><i class="bi bi-pencil"></i></a>
                    <form action="{{ route('articles.destroy', $item) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" aria-label="Elimina {{ $item->name }}"><i
                                class="bi bi-trash"></i></button>
                    </form>
                </div>
            </div>
        @endif
    </div>
</div>

<div>
    @if (session()->has('message'))
        <div class="alert alert-custom">
            {{ session('message') }}
        </div>
    @endif
    <form wire:submit= 'addToCart'>
        @csrf
        <div>
            <div class="d-flex gap-2 align-items-center"> <label for="quantity">Seleziona la quantità
                    desiderata</label>
                <input type="number" wire:model.live="quantity" id="quantity" max="20" class="form-control w-25"
                    min="1" required>
            </div>
            <div>Prezzo: €{{ $this->totalPrice }}</div>
        </div>
        <button id="submitCart" type="submit" class="btn btn-custom--sec">Aggiungi al carrello</button>
    </form>
</div>

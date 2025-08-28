<div class="row">
    <form wire:submit.prevent="storeOrder" class="mb-4">
        @csrf
        <div class="col-12 col-md-6">
            <!-- Form per i dati di spedizione -->
            <div class="form-group">
                <label for="name">Nome</label>
                <input type="text" class="form-control" id="name" placeholder="Nome" disabled
                    value="@if (auth()->user()) {{ auth()->user()->name }} @endif">
            </div>
            <div class="form-group">
                <label for="last_name">Cognome</label>
                <input type="text" class="form-control" id="last_name" placeholder="Cognome" disabled
                    value="@if (auth()->user()) {{ auth()->user()->last_name }} @endif">
            </div>
            <div class="form-group">
                <label for="address">Via</label>
                <input type="text" class="form-control" id="address" placeholder="Via Vittorio Emanuele 1"
                    wire:model="address">
                @error('address')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="city">Città</label>
                <input type="text" class="form-control" id="city" placeholder="Roma" wire:model="city">
                @error('city')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="zip">CAP</label>
                <input type="text" class="form-control" id="zip" placeholder="00148" wire:model="zip">
                @error('zip')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="country">Paese</label>
                <input type="text" class="form-control" id="country" placeholder="Paese" wire:model="country">
                @error('country')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <!-- Form per il pagamento -->
            <div class="my-3">
                <h2>Metodo di pagamento</h2>
                <h6>Solo a scopo dimostrativo, si prega di inserire dati falsi per procedere alla simulazione
                    dell'ordine</h6>
            </div>
            <div class="form-group">
                <label for="cardNumber">Numero carta</label>
                <input type="number" class="form-control" id="cardNumber" placeholder="•••• ••• •••••••"
                    wire:model="card_number">
                @error('card_number')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="expiry">Data scadenza</label>
                <input type="number" class="form-control" id="expiry" placeholder="MM/YY" wire:model="expiry_date">
                @error('expiry_date')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="cvv">CVV</label>
                <input type="number" class="form-control" id="cvv" placeholder="•••" wire:model="cvv">
                @error('cvv')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="my-3">
                <h2>Riepilogo ordine</h2>
            </div>
            @if (!$cart || $cart->items->isEmpty())
                <p>Il carrello è vuoto.</p>
            @else
                <ul class="list-group">
                    @foreach ($cart->items as $item)
                        <li class="list-group-item d-flex justify-content-between align-items-center bg-custom">
                            @if ($item->article)
                                {{ $item->article->name }} (x{{ $item->quantity }})
                                <span>€{{ number_format($item->quantity * $item->article->price, 2, ',', '.') }}</span>
                                <button wire:click="removeItem({{ $item->id }})"
                                    class="btn btn-danger">Rimuovi</button>
                            @else
                                <span>Articolo non disponibile</span>
                            @endif
                        </li>
                    @endforeach
                </ul>
            @endif

            <div class="mt-4">
                <h4 class="m-0">Totale Carrello: &euro; {{ number_format($this->getCartTotal(), 2, ',', '.') }}</h4>
                @if ($cart && !$cart->items->isEmpty())
                    <button type="submit" class="btn btn-custom my-2">
                        Completa ordine
                    </button>
                @endif
            </div>
        </div>
    </form>
</div>

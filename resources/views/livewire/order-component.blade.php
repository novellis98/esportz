<form wire:submit.prevent="storeOrder" class="mb-4">
    @csrf
    <div class="row">
        <div class="col-12 col-md-6">
            <!-- Form per i dati di spedizione -->
            <div class="form-group
            ">
                <label for="name">Nome</label>
                <input type="text" class="form-control" id="name" placeholder="Nome" disabled
                    value="@if (auth()->user()) {{ auth()->user()->name }} @endif">
            </div>
            <div class="form-group
            ">
                <label for="last_name">Cognome</label>
                <input type="text" class="form-control" id="last_name" placeholder="Cognome"disabled
                    value="@if (auth()->user()) {{ auth()->user()->last_name }} @endif">
            </div>
            <div class="form-group">
                <label for="address">Via</label>
                <input type="text" class="form-control" id="address" placeholder="Via Vittorio Emanuele 1"
                    wire:model="address" required>
                @error('address')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="city">Città</label>
                <input type="text" class="form-control" id="city" placeholder="Roma" wire:model="city" required>
                @error('city')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="zip">CAP</label>
                <input type="text" class="form-control" id="zip" placeholder="00148" wire:model="zip" required>
                @error('zip')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="country">Paese</label>
                <input type="text" class="form-control" id="country" placeholder="Paese" wire:model="country"
                    required>
                @error('country')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <!-- Form per il pagamento -->
            <div class="my-3">
                <h2>Metodo di pagamento</h2>
                <h6>Form del pagamento disabilitato, solo a scopo dimostrativo</h6>
            </div>
            <div class="form-group">
                <label for="cardNumber">Numero carta</label>
                {{-- <input type="text" class="form-control" id="cardNumber" placeholder="1234 5678 9012 3456"
                    wire:model="card_number" pattern="\d{16}"
                    title="Il numero di carta deve essere composto da 16 cifre" required>
                @error('card_number')
                    <span class="text-danger">{{ $message }}</span>
                @enderror --}}
                <input type="text" value="5333 1234 5678 9876" class="form-control" disabled>
            </div>
            <div class="form-group">
                <label for="expiry">Data scadenza</label>
                <div class="d-flex gap-2 align-content-center">
                    {{-- <input type="text" class="form-control w-25" id="expiry_month" placeholder="MM"
                        wire:model="expiry_month" pattern="^(0[1-9]|1[0-2])$" title="Inserisci un mese valido (01-12)"
                        required> --}}
                    <input type="number" value="07" class="form-control w-25" disabled>
                    <span>/</span>
                    {{-- <input type="text" class="form-control w-25" id="expiry_year" placeholder="YY"
                        wire:model="expiry_year" pattern="^\d{2}$" title="Inserisci un anno valido (due cifre)"
                        required> --}}
                    <input type="number" value="26" class="form-control w-25" disabled>
                </div>
            </div>
            <div class="form-group">
                <label for="cvv">CVV</label>
                {{-- <input type="text" class="form-control w-25" id="cvv" placeholder="123" wire:model="cvv"
                    pattern="\d{3,4}" title="Il CVV deve essere composto da 3 o 4 cifre" required>
                @error('cvv')
                    <span class="text-danger">{{ $message }}</span>
                @enderror --}}
                <input type="number" value="456" class="form-control w-25" disabled>
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
                                <button wire:click="removeItem({{ $item->id }})" class="btn btn-danger"><i
                                        class="bi bi-trash"></i></button>
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
    </div>
</form>

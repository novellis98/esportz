<div>
    <div>
        @if (!$cart || $cart->items->isEmpty())
            <p>Il carrello è vuoto.</p>
        @else
            <ul class="list-group">
                @foreach ($cart->items as $item)
                    <li class="list-group-item d-flex justify-content-between align-items-center bg-custom">
                        @if ($item->article)
                            {{ $item->article->name }} (x{{ $item->quantity }})
                            <span>€{{ number_format($item->quantity * $item->article->price, 2, ',', '.') }}</span>
                            <button wire:click="removeItem({{ $item->id }})" class="btn btn-danger">Rimuovi</button>
                        @else
                            <span>Articolo non disponibile</span>
                        @endif
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
    <div class="mt-4">
        <h4 class="m-0">Totale Carrello: &euro; {{ number_format($this->getCartTotal(), 2, ',', '.') }}</h4>
        @if (!request()->routeIs('orders.index') && $cart && !$cart->items->isEmpty())
            <a href="{{ route('orders.index') }}" class="btn btn-custom my-2">
                Procedi al Checkout
            </a>
        @endif
    </div>
</div>

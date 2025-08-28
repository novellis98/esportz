<x-layout title="order {{ $order->id }}">
    <div class="container">
        <h1 class="text-center my-5">Ordine #{{ $order->id }}</h1>

        <div class="row">
            <div class="col-12">
                <p><strong>Data ordine:</strong> {{ $order->created_at }}</p>
                <p><strong>Indirizzo di spedizione:</strong> {{ $order->address->address }},
                    {{ $order->address->city }}, {{ $order->address->zip }}, {{ $order->address->country }}</p>
                <p><strong>Totale ordine:</strong> €{{ $order->total }}</p>

                <h4>Dettagli ordine:</h4>
                <div class="table-responsive">
                    <table class="table table-dark table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Articolo</th>
                                <th scope="col">Quantità</th>
                                <th scope="col">Prezzo unitario</th>
                                <th scope="col">Totale</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->orderItems as $item)
                                <tr>
                                    <td><a
                                            href="{{ route('articles.show', ['id' => $item->article->id]) }}">{{ $item->article->name }}</a>
                                    </td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>&euro; {{ $item->price }}</td>
                                    <td>&euro; {{ $item->quantity * $item->price }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <p><strong>Stato dell'ordine:</strong> Completato</p>

                <!-- Paginazione per eventuali ordini correlati -->
                <div class="d-flex justify-content-center">
                    <nav>
                        @if (auth()->user()->role == 'user')
                            <a href="{{ route('orders.user-orders') }}" class="btn btn-custom">Torna agli ordini</a>
                        @elseif (auth()->user()->role == 'admin')
                            <a href="{{ route('dashboard') }}" class="btn btn-custom">Torna agli ordini</a>
                        @endif
                    </nav>
                </div>
            </div>
        </div>
    </div>
</x-layout>

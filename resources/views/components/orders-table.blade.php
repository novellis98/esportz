<div class="container">
    <h1 class="text-center my-3">Ordini</h1>
    <div class="row">
        <div class="col-12">
            @if (auth()->user()->role == 'user' && $orders->isEmpty())
                <p class="text-center">Non hai ancora effettuato ordini.</p>
            @elseif (auth()->user()->role == 'admin' && $orders->isEmpty())
                <p class="text-center">Nessun ordine ricevuto</p>
            @else
                <div class="table-responsive">
                    <table class="table table-dark table-striped  ">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Data</th>
                                <th scope="col">Totale</th>
                                <th scope="col">Indirizzo</th>
                                <th scope="col">Stato</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr style="cursor: pointer"
                                    onclick="window.location='{{ route('orders.show', $order->id) }}'">
                                    <th scope="row"># {{ $order->id }}</th>
                                    <td>{{ $order->created_at }}</td>
                                    <td>&euro; {{ $order->total }}</td>
                                    <td>{{ $order->address->address }}</td>
                                    <td>Completato</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <!-- Paginazione -->
                    <div class="d-flex justify-content-center ">
                        <nav>
                            {{ $orders->links('pagination::bootstrap-4') }}
                        </nav>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

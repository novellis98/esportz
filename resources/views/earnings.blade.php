<x-layout :title="'guadagni'">
    <div data-aos="fade-right">
        <h1 class="text-center text-uppercase my-4">Sports Community</h1>
    </div>
    <div class="container">
        <div class="row">
            <!-- Guadagni Totali -->
            <div class="col-12 col-md-6 d-flex justify-content-center mb-4">
                <div
                    class="bg-custom p-4 rounded w-75 d-flex justify-content-center align-items-center flex-column gap-4">
                    <h3 class="text-center">Guadagni</h3>
                    <p>Guadagni totali: €{{ number_format($totalEarnings, 2) }}</p>
                </div>
            </div>

            <!-- Articolo Più Acquistato -->
            <div class="col-12 col-md-6 d-flex justify-content-center mb-4">
                <div
                    class="bg-custom p-4 rounded w-75 d-flex justify-content-center align-items-center flex-column gap-4">
                    <h3 class="text-center">Articolo più acquistato</h3>
                    @if ($mostPurchasedItemDetails)
                        <p><strong>{{ $mostPurchasedItemDetails->name }}</strong>: acquistato
                            {{ $mostPurchasedItem->total_quantity }} volte</p>
                    @else
                        <p>Nessun articolo acquistato.</p>
                    @endif
                </div>
            </div>

            <!-- Cliente Più Attivo -->
            <div class="col-12 col-md-6 d-flex justify-content-center mb-4">
                <div
                    class="bg-custom p-4 rounded w-75 d-flex justify-content-center align-items-center flex-column gap-4">
                    <h3 class="text-center">Cliente più attivo</h3>
                    @if ($mostActiveCustomerDetails)
                        <p><strong>{{ $mostActiveUser->name }}</strong> ha acquistato
                            {{ $mostPurchasedItem->total_quantity }} articoli
                        </p>
                        <p>Totale speso: €{{ number_format($totalSpentByCustomer, 2) }}</p>
                    @else
                        <p>Nessun cliente attivo.</p>
                    @endif
                </div>
            </div>

            <!-- Utente con Più Recensioni -->
            <div class="col-12 col-md-6 d-flex justify-content-center mb-4">
                <div
                    class="bg-custom p-4 rounded w-75 d-flex justify-content-center align-items-center flex-column gap-4">
                    <h3 class="text-center">Utente che ha lasciato più recensioni</h3>
                    @if ($mostActiveReviewerDetails)
                        <p>{{ $mostActiveReviewerDetails->name }}: {{ $mostActiveReviewer->total_reviews }} recensioni
                        </p>
                    @else
                        <p>Nessuna recensione.</p>
                    @endif
                </div>
            </div>
            <div class="container mt-5">
                <h2 class="text-center">Statistiche di guadagni</h2>
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="d-flex justify-content-center gap-2 m-1 align-items-center">
                            <button id="prevMonth" class="bg-custom btn"><i class="bi bi-arrow-left "></i></button>
                            <span id="currentMonth" style="font-size: 18px; font-weight: bold;"></span>
                            <button id="nextMonth" class="bg-custom btn"><i
                                    class="bi bi-arrow-right nav-link bg-custom"></i></button>
                        </div>
                        <canvas id="lineChart"></canvas>
                        <canvas id="lineChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        const dailyData = @json($dailyData);
    </script>
</x-layout>

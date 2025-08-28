<x-layout :title="'admin'">
    <div data-aos="fade-right">
        <h1 class="text-center text-uppercase my-4">Sports Community</h1>
    </div>
    <div class="container">
        <div class="row ">
            <div class="col-md-6 my-2 col-12 d-flex justify-content-center align-items-center  ">
                <div class="bg-custom p-4 rounded w-75 d-flex justify-content-center align-items-center flex-column ">
                    <h3>Articoli</h3>
                    <a href="{{ route('articles.create') }}" class="btn btn-custom">Aggiungi articolo</a>
                </div>
            </div>
            <div class="col-md-6 my-2 col-12 d-flex justify-content-center align-items-center">
                <div class="bg-custom p-4 rounded w-75 d-flex justify-content-center align-items-center flex-column  ">
                    <h3>Recensioni</h3>
                    <a href="{{ route('reviews.admin') }}" class="btn btn-custom">Vedi ultime recensioni</a>
                </div>
            </div>
        </div>
        <x-orders-table :orders="$orders" />
    </div>


</x-layout>

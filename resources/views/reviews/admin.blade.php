<x-layout :title="'recensioni'">
    <x-alert />
    <div data-aos="fade-right">
        <h1 class="text-center text-uppercase my-4">Sports Community</h1>
    </div>
    <div class="container">
        <div class="row ">
        </div>
        <x-reviews-table :reviews="$reviews" />
    </div>


</x-layout>

<x-layout :title="'homepage'">
    @if (session()->has('emailSent'))
        <div class="alert alert-custom" id="messageEmail">
            {{ session('emailSent') }}
        </div>
    @endif
    @if (session()->has('emailError'))
        <div class="alert alert-custom" id="messageEmail">
            {{ session('emailError') }}
        </div>
    @endif
    <script>
        setTimeout(function() {
            document.getElementById('messageEmail').style.display = 'none';
        }, 2000);
    </script>
    <div data-aos="fade-right">
        <h1 class="text-center text-uppercase my-4">Sports Community</h1>
    </div>

    <!-- Slider  -->
    <div class="swiper ">
        <div class="swiper-wrapper ">
            <!-- Slides -->
            <div class="swiper-slide d-flex justify-content-center align-content-center">
                <img class="slider-photo" src="{{ Storage::url('images/1.jpg') }}" alt="foto calcio">
            </div>
            <div class="swiper-slide d-flex justify-content-center align-content-center">
                <img class="slider-photo" src="{{ Storage::url('images/2.jpg') }}" alt="foto pallavolo">
            </div>
            <div class="swiper-slide d-flex justify-content-center align-content-center"><img class="slider-photo"
                    src="{{ Storage::url('images/3.jpg') }}" alt="foto basket">
            </div>
            <div class="swiper-slide d-flex justify-content-center align-content-center"><img class="slider-photo"
                    src="{{ Storage::url('images/4.jpg') }}" alt="foto basket">
            </div>
        </div>

        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
        <!-- <div class="swiper-scrollbar"></div> -->
    </div>
    <div class="container my-5">
        <h2 class="text-center mb-5">Cosa dicono i nostri clienti</h2>
        <div class="row justify-content-around">
            <div class="col-md-4 mb-2">
                <div class="testimonial">
                    <p>"Questo negozio è fantastico! I prodotti sono di alta qualità e la spedizione è veloce."</p>
                    <p><strong>Mario Rossi</strong></p>
                </div>
            </div>
            <div class="col-md-4 mb-2">
                <div class="testimonial d-flex flex-column align-items-center justify-content-center">
                    <p>Sinonimo di qualità e convenienza</p>
                    <img style="width: 100%" src="{{ Storage::url('images/stars.png') }}" alt="stars">
                </div>
            </div>
        </div>
    </div>
</x-layout>

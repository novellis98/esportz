<x-layout :title="'Contattaci'">
    <h1 class="text-center mt-5">Contattaci</h1>
    <div class=" d-flex align-items-center  justify-content-center" style="height: 50vh;">
        <form class="col-9 col-sm-5" method="post" action="{{ route('contactUs') }}">
            @csrf
            <div class="form-group mb-2">
                <label for="name">Inserisci il tuo nome</label>
                <input type="text" class="form-control" id="name" placeholder="Inserisci il tuo nome"
                    name="name">
            </div>
            <div class="form-group mb-2">
                <label for="email">Inserisci la tua email</label>
                <input type="email" class="form-control" id="email" aria-describedby="emailHelp"
                    placeholder="Inserisci la tua email" name="email">
            </div>
            <div class="form-group mb-2">
                <label for="message">Inserisci messaggio</label>
                <textarea name="message" id="message" class="form-control" placeholder="inserisci testo"></textarea>
            </div>
            <button type="submit" class="btn btn-custom">Invia email</button>
        </form>
    </div>
</x-layout>

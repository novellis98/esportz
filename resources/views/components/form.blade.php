<form class="col-9 col-sm-5" method="post" action="{{ route('contactUs') }}">
    @csrf
    <div class="form-group">
        <label for="name">Inserisci il tuo nome</label>
        <input type="text" class="form-control" id="name" placeholder="Inserisci il tuo nome" name="user">
    </div>
    <div class="form-group">
        <label for="email">Inserisci la tua email</label>
        <input type="email" class="form-control" id="email" aria-describedby="emailHelp"
            placeholder="Inserisci la tua email" name="email">
    </div>
    <div class="form-group">
        <label for="user-message">Inserisci messaggio</label>
        <textarea name="user-message" id="user-message" class="form-control" placeholder="inserisci testo"></textarea>
    </div>
    {{-- <div class="form-check">
        <input type="checkbox" class="form-check-input" id="newsletter" name="newsletter">
        <label class="form-check-label" for="newsletter">Registrati alla newsletter</label>
    </div> --}}
    <button type="submit" class="btn btn-custom">Invia</button>
</form>

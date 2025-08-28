<x-layout title="accedi">
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-12 col-md-6">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" aria-describedby="emailHelp"
                            name="email" value="{{ old('email') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    @if ($errors->has('login_error'))
                        <div class="alert alert-custom">
                            {{ $errors->first('login_error') }}
                        </div>
                    @endif
                    <div class="mt-3 text-center">
                        <a href="{{ route('password.request') }}" tabindex="3">Password dimenticata? </a>
                    </div>
                    <button type="submit" class="btn btn-custom">Accedi</button>
                </form>
                <div class="mt-3 text-center">
                    <p>Non hai un account? <a href="{{ route('register') }}">Registrati</a></p>
                </div>
            </div>
        </div>
    </div>
</x-layout>

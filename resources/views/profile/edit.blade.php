<x-layout title="aggiorna profilo">
    <div class="container my-5">
        @if (session('status') == 'profile-information-updated')
            <div class="alert alert-custom" id="messagePassword">
                Il tuo profilo è stata aggiornato con successo
            </div>
            <script>
                setTimeout(function() {
                    document.getElementById('messagePassword').style.display = 'none';
                }, 2000);
            </script>
        @endif
        @if (session('status') == 'password-updated')
            <div class="alert alert-custom" id="messagePassword">
                La tua password è stata aggiornata con successo
            </div>
            <script>
                setTimeout(function() {
                    document.getElementById('messagePassword').style.display = 'none';
                }, 2000);
            </script>
        @endif
        <div class="row justify-content-center">
            <div class="col-12 col-md-6">
                <form method="POST" action="{{ route('user-profile-information.update') }}">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="name" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="name" name="name"
                            value="{{ old('name') ?? auth()->user()->name }}">
                        @error('name')
                            <span class="error text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="last_name" class="form-label">Cognome</label>
                        <input type="text" class="form-control" id="last_name" name="last_name"
                            value="{{ old('last_name') ?? auth()->user()->last_name }}">
                        @error('last_name')
                            <span class="error text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" aria-describedby="emailHelp"
                            name="email" value="{{ old('email') ?? auth()->user()->email }}">
                        @error('email')
                            <span class="error text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-custom">Aggiorna profilo</button>
                </form>

                <form method="POST" action="{{ route('user-password.update') }}" class="mt-5">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="current_password" class="form-label">Password attuale</label>
                        <input type="password" class="form-control" id="current_password" name="current_password">
                        @error('current_password', 'updatePassword')
                            <span class="error text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Nuova Password</label>
                        <input type="password" class="form-control" id="password" name="password">
                        @error('password', 'updatePassword')
                            <span class="error text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Conferma nuova password</label>
                        <input type="password" class="form-control" id="password_confirmation"
                            name="password_confirmation">
                        @error('password_confirmation', 'updatePassword')
                            <span class="error text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-custom">Aggiorna password</button>
                </form>
            </div>
        </div>
    </div>
</x-layout>

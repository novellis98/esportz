<x-layout title="recupera password">
    <div class="container my-5">
        @if (isset($message))
            <div class="alert alert-custom" id="messagePassword">
                {{ $message }}
            </div>
            <script>
                setTimeout(function() {
                    document.getElementById('messagePassword').style.display = 'none';
                }, 2000);
            </script>
        @endif
        <div class="row justify-content-center">
            <div class="col-12 col-md-6">
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="mb-5">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" aria-describedby="emailHelp"
                            name="email" value="{{ old('email') }}" required>
                    </div>
                    <button type="submit" class="btn btn-custom">Recupera password</button>
                </form>
            </div>
        </div>
    </div>
</x-layout>

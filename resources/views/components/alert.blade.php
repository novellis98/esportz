@if (session()->has('message'))
    <div id="sessionMessage" class="alert alert-custom">
        {{ session('message') }}
    </div>
    <script>
        setTimeout(function() {
            document.getElementById('sessionMessage').style.display = 'none';
        }, 2000);
    </script>
@endif

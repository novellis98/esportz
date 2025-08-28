<div class="container-fluid footer">
    <footer class="py-3 my-0">
        <ul class="nav justify-content-center border-bottom pb-3 mb-3">
            <li class="nav-item"><a href="{{ route('homepage') }}" class="nav-link px-2">Home</a></li>
            <li class="nav-item"><a href="{{ route('articles.index') }}" class="nav-link px-2">Articoli</a></li>
            <li class="nav-item"><a href="{{ route('contattaci') }}" class="nav-link px-2">Contattaci</a></li>
        </ul>

        <div class="d-flex justify-content-center gap-4 w-100">
            <div class="d-flex">
                <div class="d-flex gap-5 mx-auto justify-content-center align-items-center flex-column flex-sm-row">
                    <div>
                        <a href="https://www.umbertonovellis.dev/" target="_blank">
                            <img id="logo" src="{{ Storage::url('images/logo-nero.png') }}" alt="foto logo"
                                style="height: 3rem">
                        </a>
                    </div>
                    <div class="d-flex gap-2">© 2025 Sports Community
                        <a href="https://www.umbertonovellis.dev/" target="_blank">Umberto Novellis</a>
                    </div>
                    <div class="d-flex gap-3">
                        <a href="https://x.com/novellis98" target="_blank">
                            <i class="bi bi-twitter-x text-primary"></i>
                        </a>
                        <a href="https://www.linkedin.com/in/umberto-novellis/" target="_blank">
                            <i class="bi bi-linkedin text-primary"></i>
                        </a>
                        <a href="https://github.com/novellis98" target="_blank">
                            <i class="bi bi-github text-primary"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center mt-3">
            <a href="https://www.iubenda.com/privacy-policy/46947958"
                class="iubenda-white iubenda-noiframe iubenda-embed" title="Privacy Policy">Privacy Policy</a> |
            <a href="https://www.iubenda.com/privacy-policy/46947958/cookie-policy"
                class="iubenda-white iubenda-noiframe iubenda-embed" title="Cookie Policy">Cookie Policy</a> |
            <a href="https://www.iubenda.com/termini-e-condizioni/46947958"
                class="iubenda-white iubenda-noiframe iubenda-embed" title="Termini e Condizioni">Termini e
                Condizioni</a>
        </div>
    </footer>
</div>

<script type="text/javascript">
    (function(w, d) {
        var loader = function() {
            var s = d.createElement("script"),
                tag = d.getElementsByTagName("script")[0];
            s.src = "https://cdn.iubenda.com/iubenda.js";
            tag.parentNode.insertBefore(s, tag);
        };
        if (w.addEventListener) {
            w.addEventListener("load", loader, false);
        } else if (w.attachEvent) {
            w.attachEvent("onload", loader);
        } else {
            w.onload = loader;
        }
    })(window, document);
</script>

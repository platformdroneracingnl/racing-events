<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-3">
                <script>document.write(new Date().getFullYear())</script> © <a href="https://platformdroneracing.nl">PDRNL</a>
            </div>
            <div class="col-sm-9">
                <div class="text-sm-end d-none d-sm-block">
                    @auth
                        @if(auth()->user()->hasRole(['manager','supervisor']))
                            Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }}) | 
                        @endif
                    @endauth
                    Created <i class="mdi mdi-heart text-danger"></i> by <a href="https://github.com/klaasnicolaas" target="_blank" class="text-reset">klaasnicolaas</a>
                </div>
            </div>
        </div>
    </div>
</footer>
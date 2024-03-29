<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-3">
                @php echo date("Y"); @endphp © <a href="https://platformdroneracing.nl">PDRNL</a> - @lang('pdrnl.rights').
            </div>
            <div class="col-sm-9">
                <div class="text-sm-end d-none d-sm-block">
                    @auth
                        @if(auth()->user()->hasRole(['manager','supervisor']))
                            Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }}) | 
                        @endif
                    @endauth
                    @version('compact') |
                    Created <i class="mdi mdi-heart text-danger"></i> by <a href="https://github.com/klaasnicolaas" target="_blank" class="text-reset">klaasnicolaas</a>
                </div>
            </div>
        </div>
    </div>
</footer>
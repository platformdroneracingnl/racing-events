<div class="modal fade" id="deleteAccountModel" tabindex="-1" aria-labelledby="deleteAccountModelLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteAccountModelLabel">Verwijder mijn account</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('profile.destroy', auth()->user()) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <!-- Avatar -->
                    <div class="row">
                        <div class="col">
                            <p>Weet je het heel zeker? Na bevestiging wordt je account verwijderd en is het niet meer mogelijk om in te schrijven voor wedstrijden.</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Nee, annuleer</button>
                    <button type="submit" class="btn btn-success">Ja!</button>
                </div>
            </form>
        </div>
    </div>
</div>
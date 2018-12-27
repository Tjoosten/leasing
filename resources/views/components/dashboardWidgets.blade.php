<div class="col-3">
    <div class="card shadow-sm mb-4 p-2">
        <div class="d-flex align-items-center">
            <span class="stamp stamp-md shadow-sm bg-green-stamp mr-3">
                <i class="fe text-sgv-brown fe-check-circle"></i>
            </span>

            <div>
                <h5 class="m-0">0 <small>Aanvragen</small></h5>
                <small class="text-muted">0 vandaag geregistreerd</small>
            </div>
        </div>
    </div>
</div>

<div class="col-3">
    <div class="card shadow-sm mb-4 p-2">
        <div class="d-flex align-items-center">
            <span class="stamp stamp-md shadow-sm bg-green-stamp mr-3">
                <i class="fe text-sgv-brown fe-users"></i>
            </span>

            <div>
                <h5 class="m-0">{{ $users->count() }} <small>Gebruikers</small></h5>
                <small class="text-muted">{{ $users->registeredToday()->count() }} vandaag geregistreerd</small>
            </div>
        </div>
    </div>
</div>

<div class="col-3">
    <div class="card shadow-sm mb-4 p-2">
        <div class="d-flex align-items-center">
            <span class="stamp stamp-md shadow-sm bg-green-stamp mr-3">
                <i class="fe text-sgv-brown fe-help-circle"></i>
            </span>

            <div>
                <h5 class="m-0">0 <small>Tickets</small></h5>
                <small class="text-muted">0 tickets toegewezen</small>
            </div>
        </div>
    </div>
</div>

@extends('layouts.app')

@section('content')
     <div class="page-header">
        <h1 class="page-title">{{ Auth::user()->name }}</h1>

        <div class="page-subtitle">Verwijder gebruikersaccount</div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <account-sidenav></account-sidenav>
        </div>

        <div class="col-md-9">
            <form action="" method="POST" class="card card-body shadow-sm py-3 mb-3">
                <h6 class="border-bottom border-gray pb-1 mb-3">Account verwijderen</h6> 

                <p class="card-text text-danger">
                    <i class="fe fe-alert-triangle mr-1"></i>
                    Bij het verwijderen van je account. Zal je niet meer kunnen inloggen in de applicatie van {{ config('app.name') }}. <br> 
                    En zal ook als gevolg al jouw data verwijderd worden na een termijn van 30 dagen. 
                </p>

                <p class="card-text">
                    Wij houden jouw data bij met een termijn van 30 dagen voor het geval de verwijdering van jouw account een vergissng was. <br>
                    Zodat de webmaster de verwijdering van je account makklijk ongedaan kan maken. 
                </p>

                <p class="card-text mt-1 mb-0">Om het account te verwijderen kan u het onderstaand formulier invullen ter bevestiging.</p>
                <hr>

                <h5 class="card-title mb-3 mt-2">Bevestigings formulier</h5>

                <div class="form-row">
                    <div style="margin-bottom: .5rem;" class="form-group col-md-4">
                        <input type="password" @input('confirmation') class="form-control @error('confirmation', 'is-invalid')" id="inputEmail4" placeholder="Uw wachtwoord ter controle">
                        @error('confirmation')
                    </div>
                </div>
            

                <div class="form-group">
                    <button type="submit" class="rounded btn btn-danger"><i class="fe fe-user-minus mr-1"></i> Bevestig</button>
                    <a href="{{ route('admins.index') }}" class="btn btn-light rounded">Annuleer</a>
                </div>
            </form>
        </div>
    </div>
@endsection
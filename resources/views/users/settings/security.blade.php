@extends('layouts.app')

@section('content')
    <div class="page-header">
        <h1 class="page-title">{{ Auth::user()->name }}</h1>

        <div class="page-subtitle">Beveiligings instellingen</div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <account-sidenav></account-sidenav>
        </div>

        <div class="col-md-9">
            <form action="{{ route('account.settings.security') }}" method="POST" class="card card-body shadow-sm py-3 mb-3">
                @csrf               {{-- Form filed protection --}}
                @method('PATCH')    {{-- HTTP method spoofing --}}

                <h6 class="border-bottom border-gray pb-1 mb-3">Beveiligings instellingen</h6>

                @include('flash::message') {{-- Flash session view partial --}}

                <div class="form-row">
                    <div class="form-group col-12">
                        <label for="currentPassword">Huidig wachtwoord <span class="text-danger">*</span></label>
                        <input type="password" @input('current_password') class="@error('current_password', 'is-invalid') form-control" id="currentPassword" placeholder="Uw huidig wachtwoord">
                        @error('current_password')
                    </div>

                    <div class="form-group col-6">
                        <label for="password">Wachtwoord <span class="text-danger">*</span></label>
                        <input type="password" @input('password') class="form-control @error('password', 'is-invalid')" id="password" placeholder="Nieuw wachtwoord">
                        @error('password')
                    </div>
            
                    <div class="form-group col-6">
                        <label for="passwordConfirmation"> Herhaal wachtwoord <span class="text-danger">*</span></label>
                        <input type="password" @input('password_confirmation') class="form-control" id="passwordConfirmation" placeholder="Herhaal wachtwoord">
                    </div>
                </div>

                <hr class="mt-0">

                <div class="form-row">
                    <div class="form-group mb-0 col-6">
                        <button type="submit" class="btn btn-success">Aanpassen</button>
                        <button type="reset" class="btn btn-light">Annuleren</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
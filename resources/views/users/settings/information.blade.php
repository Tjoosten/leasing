@extends('layouts.app')

@section('content')
    <div class="page-header">
        <h1 class="page-title">{{ Auth::user()->name }}</h1>

        <div class="page-subtitle">Informatie instellingen</div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <account-sidenav></account-sidenav>
        </div>

        <div class="col-md-9">
            <form action="{{ route('account.settings.information') }}" method="POST" class="card card-body shadow-sm py-3 mb-3">
                @csrf               {{-- Form filed protection --}}
                @method('PATCH')    {{-- HTTP method spoofing --}}
                @form(Auth::user()) {{-- Bind the data from the authenticated used to the form --}}

                <h6 class="border-bottom border-gray pb-1 mb-3">Informatie instellingen</h6> 

                <div class="form-row">
                    <div class="form-group col-12">
                        <label for="name">Uw naam <span class="text-danger">*</span></label>
                        <input type="text" @input('name') class="form-control @error('name', 'is-invalid')" id="name" placeholder="Uw voor en achternaam">
                        @error('name')
                    </div>

                    <div class="form-group col-6">
                        <label for="email">Uw E-mail adres: <span class="text-danger">*</span></label>
                        <input type="email" @input('email') class="form-control @error('email', 'is-invalid')" id="email" placeholder="Uw E-mail adres">
                        @error('email')
                    </div>

                    <div class="form-group col-6">
                        <label for="phoneNumber">Uw Tel. nummer</label>
                        <input type="text" @input('telephone_number') class="form-control @error('telephone_number', 'is-invalid')" id="phoneNumber" placeholder="Uw telefoon nummer">
                        @error('telephone_number')
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
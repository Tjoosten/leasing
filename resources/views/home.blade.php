@extends('layouts.app')

@section('content')
   <div class="row">
        @if (session('status')) {{-- Nodig voor bepaalde handelingen zoals het resetten van een wachtwoord --}}
            <div class="col-12">
                <div class="alert alert-success">
                    <small>{{ session('status') }}</small>
                </div>
            </div>
        @endif

        <dashboard-widgets :users="$users"></dashboard-widgets>
    </div>        

@endsection

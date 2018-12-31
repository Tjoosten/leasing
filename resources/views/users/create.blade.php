@extends ('layouts.app')

@section('content')
    <div class="page-header">
        <h1 class="page-title">Administrators & leiding</h1>

        <div class="page-subtitle">Gebruiker toevoegen</div>

        </div>
    </div>

    <form action="" method="POST" class="card col-md-12 card-body shadow-sm py-3 mb-3">
        @csrf {{-- Form filed protection --}}

        <div class="form-row">
            <div class="col-6">
                <label for="inputEmail4">Naam van de gebruiker</label>
                <input type="text" class="form-control" placeholder="First name">
            </div>
    
            <div class="col-6">
                <label for="inputEmail4">Email adres van de gebruiker</label>
                <input type="text" class="form-control" placeholder="Last name">
            </div>

            <div class="col-6">
            </div>
            
            <div class="col-6">
            </div>
        </div>
    </form>
@endsection
@extends ('layouts.app')

@section('content')
    <div class="page-header">
        <h1 class="page-title">Administrators & leiding</h1>

        <div class="page-subtitle">Gebruiker toevoegen</div>

        </div>
    </div>

    <form action="{{ route('admins.store') }}" method="POST" class="card col-md-12 card-body shadow-sm py-3 mb-3">
        @csrf {{-- Form filed protection --}}

        <div class="form-row">
            <div class="form-group col-12">
                <label for="inputName">Naam van de leider of admin <span class="text-danger">*</span></label>
                <input id="inputName" type="text" @input('name') class="form-control @error('name', 'is-invalid')" placeholder="Gebruikersnaam">
                @error('name')
            </div>

            <div class="form-group col-6">
                <label for="inputEmail">Email adres <span class="text-danger">*</span></label>
                <input type="email" id="inputEmail" @input('email') class="form-control @error('email', 'is-invalid')" placeholder="E-mail adres van de gebruiker">
                @error('email')
            </div>

            <div class="form-group col-6">
                <label for="inputPerms">Permissie rol <span class="text-danger">*</span></label>

                <select @input('role') class="form-control @error('role', 'is-invalid')" id="inputPerms">
                    @foreach ($roles as $role) {{-- Loop door de permissie rollen van de gebruiker. --}}
                        <option value="{{ $role->id }}" @if ($role->name === old('role')) selected @endif>
                            {{ ucfirst($role->name) }}
                        </option>
                    @endforeach {{-- END loop --}}
                </select>
            </div>
        </div>

        <hr class="mt-0">

        <div class="form-row">
            <div class="form-group mb-0 col-6">
                <button type="submit" class="btn btn-success">Aanmaken</button>
                <button type="reset" class="btn btn-light">Annuleren</button>
            </div>
        </div>
    </form>
@endsection
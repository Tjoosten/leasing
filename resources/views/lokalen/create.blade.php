@extends ('layouts.app')

@section ('content')
    <div class="page-header">
        <h1 class="page-title">Lokalen</h1>
        <div class="page-subtitle">Lokaal toevoegen</div>

            <div class="page-options d-flex">
                <a href="{{ route('lokalen.index') }}" class="btn tw-rounded btn-sgv-green">
                    <i class="fe fe-list mr-1"></i> Overzicht
                </a>
            </div>
        </div>
    </div>

    <form method="POST" action="{{ route('lokalen.store') }}" class="card card-body shadow-sm mb-3 py-3">
        @csrf {{-- Form field protection --}}
        
        <h6 class="border-bottom border-gray pb-1 mb-3">Lokaal toevoegen voor het domein van {{ config('app.name') }}</h6>
    
        <div class="form-row">
            <div class="form-group col-6">
                <label for="name">Naam van het lokaal <span class="text-danger">*</span></label>
                <input type="text" @input('name') class="form-control @error('name', 'is-invalid')" id="name" placeholder="Naam van het lokaal">
                @error('name')
            </div>

            <div class="form-group col-6">
                <label for="capacity">Capaciteit van het lokaal <span class="text-danger">*</span></label>

                <div class="row">
                    <div class="col-6">
                        <input  id="capacity" @input('capacity') class="form-control @error('capacity', 'is-invalid')" id="capacity" placeholder="Aantal personen">
                        @error('capacity')
                    </div>

                    <div class="col-6">
                        <select id="capacity" @input('capacity_type') class="form-control @error('capacity_type', 'is-invalid')">
                             @options($capacityTypes, 'capacity_type')
                        </select>

                        @error('capcity_type')
                    </div>
                </div>
            </div>

            <div class="form-group col-12">
                <label for="verantwoordelijke">Verantwoordelijke van het lokaal <span class="text-danger">*</span></label>
                
                <select id="verantwoordelijke" @input('verantwoordelijke') class="form-control @error('verantwoordelijke', 'is-invalid')">
                    <option value="" @if (! old('verantwoordelijke')) selected @endif>
                        Geen verantwoordelijke
                    </option>

                    @options($admins, 'verantwoordelijke')
                </select>

                @error('verantwoordelijke')
            </div>
        </div>

        <hr class="mt-0">

        <div class="form-row">
            <div class="form-group mb-0 col-6">
                <button type="submit" class="btn btn-success">Opslaan</button>
                <button type="reset" class="btn btn-light">Annuleren</button>
            </div>
        </div>
    </form>
@endsection
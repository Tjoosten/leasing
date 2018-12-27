@extends ('layouts.app')

@section('content')
    <div class="page-header">
        <h1 class="page-title">Lokaal werkpunten</h1>

        <div class="page-subtitle">Creer nieuw werkpunt</div>

            <div class="page-options d-flex">
                <a href="{{ route('lokalen.index') }}" class="btn tw-rounded btn-sgv-green">
                    <i class="fe fe-list"></i> Lokalen
                </a>
            </div>
        </div>
    </div>

    <form method="POST" action="{{ route('werkpunten.store') }}" class="card card-body shadow-sm mb-3 py-3">
        @csrf {{-- Form field protection --}}
        @include ('flash::message') {{-- Flash session view partial --}}


        <h6 class="border-bottom border-gray pb-1 mb-3">Creer een nieuw werkpunt voor een lokaal</h6>

        <div class="form-row">
            <div class="form-group col-4">
                <label for="title">Title van het werkpuntje <span class="text-danger">*</span></label>
                <input type="text" @input('title') class="form-control @error('title', 'is-invalid')" id="title" placeholder="Titel">
                @error('title')
            </div>

            <div class="form-group col-4">
                <label for="lokaal">Lokaal <span class="text-danger">*</span></label>
                
                <select id="lokaal" class="form-control @error('lokalen_id', 'is-invalid')" @input('lokalen_id')>
                    @foreach ($lokalen as $lokaal)
                        <option value="{{ $lokaal->id }}" @if (old('lokalen_id') === $lokaal->id) selected @endif>
                            {{ $lokaal->name }}
                        </option>
                    @endforeach
                </select> 
            </div>

            <div class="form-group col-12">
                <label for="extraInformatie">Extra informatie <span class="text-danger">*</span></label>
                <textarea placeholder="Extra informatie omtrent het werkpuntje" rows="7" class="form-control @error('extra_informatie', 'is-invalid')" @input('extra_informatie') id="extraInformatie">{{ old('extra_informatie') }}</textarea>
                @error('extra_informatie')
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
@extends('layouts.app')

@section('content')
    <div class="page-header">
        <h1 class="page-title">Lokalen</h1>

        <div class="page-subtitle">
            Overzicht
        </div>

            <div class="page-options d-flex">
                <div class="btn-group">
                    <button type="button" class="btn tw-rounded btn-sgv-green dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fe mr-1 fe-plus-circle"></i> Toevoegen
                    </button>

                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{ route('lokalen.create') }}">Nieuw lokaal</a>

                        @if (count($lokalen) > 0) {{-- Werkpunten zijn alleen beschikbaar wanneer er een lokaal is --}}
                            <a class="dropdown-item" href="{{ route('werkpunten.create') }}">Nieuw werkpuntje</a>
                        @endif
                    </div>
                </div>

                <form method="GET" action="" class="w-100 ml-2">
                    <input type="text" class="form-control" placeholder="Zoek lokaal">
                </form>
            </div>
        </div>
    </div>

    <div class="card card-body shadow-sm mb-3 py-3">
        @include ('flash::message') {{-- Flash session view partial --}}

        <div class="table-responsive mb-0">
            <table class="table table-sm @if (count($lokalen) > 0) table-hover @endif">
                <thead>
                    <tr>
                        <th scope="col" class="border-top-0">#</th>
                        <th scope="col" class="border-top-0">Lokaal</th>
                        <th scope="col" class="border-top-0">Verantwoordelijke</th>
                        <th scope="col" class="border-top-0">Capaciteit</th>
                        <th scope="col" class="border-top-0">Werkpunten</th>
                        <th scope="col" class="border-top-0">&nbsp;</th> {{-- Kolom alleen bedoeld voor de functie shortcuts --}}
                    </tr>
                </thead>
                <tbody>
                    @forelse ($lokalen as $lokaal) {{-- Loop door de lokalen in de applicatie --}}
                        <tr>
                            <th>#{{ $lokaal->id }}</th>
                            <td>{{ $lokaal->name }}</td>
                            <td>{!! $lokaal->responsible->name !!}</td>
                            <td>{{ $lokaal->capacity }} {{ $lokaal->capacity_type}}</td>

                            <td> {{-- Werkpunten indicator --}}
                                <a href="{{ route('werkpunten.index', ['lokaal' => $lokaal, 'status' => 'open']) }}" class="text-success no-underline">
                                    {{ $lokaal->werkpunten()->isOpen(true)->count() }} Open
                                </a>

                                <span class="text-secondary px-1">/</span>

                                <a href="{{ route('werkpunten.index', ['lokaal' => $lokaal, 'status' => 'gesloten']) }}" class="text-danger no-underline">
                                    {{ $lokaal->werkpunten()->isOpen(false)->count() }} Gesloten
                                </a>
                            </td> {{-- /// Einde werkpunten indicator --}}

                            <td> {{-- Functie shortcuts --}}
                                <span class="float-right">
                                    <a href="" class="mr-1 no-underline text-secondary">
                                        <i class="fe fe-sliders"></i>
                                    </a>

                                    <a href="" class="mr-1 no-underline text-secondary">
                                        <i class="fe fe-edit-2"></i>
                                    </a>

                                    <a href="{{ route('lokalen.delete', $lokaal) }}" class="no-underline text-danger">
                                        <i class="fe fe-x-circle"></i>
                                    </a>
                                </span>
                            </td> {{-- /// NEND functie shortcuts --}}
                        </td>
                    @empty {{-- Er zijn geen lokalen gevonden in de applicatie --}}
                    @endforelse {{-- /// END loop voor de lokalen van de gebruiker. --}}
                </tbody>
            </table>
        </div>

        {{ $lokalen->render() }} {{-- Lokalen pagination view instance --}}
    </div>
@endsection

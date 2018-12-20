@extends('layouts.app')

@section('content')
    <div class="page-header">
        <h1 class="page-title">Administrators & leiding</h1>

        <div class="page-subtitle">Beheerspaneel</div>

            <div class="page-options d-flex">
                <a href="" class="btn tw-rounded btn-sgv-green mr-2">
                    <i class="fe fe-user-plus"></i>
                </a>

                <div class="btn-group">
                    <button type="button" class="btn tw-rounded btn-sgv-green dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fe mr-1 fe-filter"></i> Filter
                    </button>
                            
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="">Non-actieve admins</a>
                        <a class="dropdown-item" href="">Verwijderde admins</a>
                    </div>
                </div>
                    
                <form method="GET" action="" class="w-100 ml-2">
                    <input type="text" class="form-control" placeholder="Zoek leiding of admin">
                </form>
            </div>
        </div>
    </div>

    <div class="card card-body shadow-sm py-3">
        @include ('flash::message') {{-- Flash session view instance --}}

        <div class="table-responsive">
            <table class="table table-sm table-hover">
                <thead>
                    <th scope="col" class="border-top-0">#</th>
                    <th scope="col" class="border-top-0">Naam</th>
                    <th scope="col" class="border-top-0">Status</th>
                    <th scope="col" class="border-top-0">Email</th>
                    <th scope="col" class="border-top-0">Tel. nummer</th>
                    <th scope="col" class="border-top-0">Laast aangemeld</th>
                    <th scope="col" class="border-top-0">Registratie datum</th>
                    <th scope="col" class="border-top-0">&nbsp;</th> {{-- Column for the options --}}
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr>
                            <th>#{{$user->id}}</th>
                            <td>{{ $user->name }}</td>
                            <td></td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->telephone_number   ? $user->telephone_number : '-' }}</td>
                            <td>{{ $user->last_login_at ? $user->last_login_at->diffForHumans() : '-' }}</td>
                            <td>{{ $user->created_at->format('d/m/Y') }}</td>
                        </tr>
                    @empty 
                    @endforelse
                </tbody>
            </table>
        </div>

        {{ $users->render() }} {{-- Pagination view instance --}}
    </div>
@endsection
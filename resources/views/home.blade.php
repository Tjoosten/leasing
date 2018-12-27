@extends('layouts.app')

@section('content')
   <div class="row">
        <dashboard-widgets :users="$users"></dashboard-widgets>
    </div>        

@endsection

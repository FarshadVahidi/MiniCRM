@extends('layouts.adminLte')

@section('header')
    @if(Session::has('message'))
        <div class="alert alert-success" role="alert">
            {{Session::get('message')}}
        </div>
    @endif

    @if(Session::has('alert'))
        <div class="alert alert-danger" role="alert">
            {{Session::get('alert')}}
        </div>
    @endif
@endsection

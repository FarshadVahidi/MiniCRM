@extends('layouts.adminLte')

@section('mainContent')

    <div class="d-flex justify-content-between">
        @if(Session::has('message'))
            <div class="alert alert-success" role="alert">
                {{Session::get('message')}}
            </div>
        @endif
    </div>

    <div class="card-body">
        <div class="d-flex">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Website</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>{{$company->name}}</td>
                    <td>{{$company->email}}</td>
                    <td>{{$company->website}}</td>
                </tr>
                </tbody>
            </table>
        </div>
        @if($company->image)
            <div>
                <img src="{{asset('storage/uploads/' . $company->image)}}" class="img-thumbnail"
                     alt="">
            </div>
        @endif
    </div>
@endsection

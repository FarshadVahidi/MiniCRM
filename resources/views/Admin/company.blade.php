@extends('Admin.index')

@section('headerContent')
    {{ __('Company Detail:') }}
@endsection

@section('mainContent')
    <div class="row">
        <div class="col-md-12 offset-md-3">
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

            @if($company->image)
                <div>
                    <img src="{{asset('storage/uploads/' . $company->image)}}" class="img-thumbnail" alt="">
                </div>
            @endif
        </div>
    </div>
@endsection

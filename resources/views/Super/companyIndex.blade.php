@extends('layouts.adminLte')

@section('mainContent')

    <div class="card-header border-0">
        <div class="d-flex justify-content-between">
            <p><a href="{{ route('Company.create') }}" class="btn btn-primary">Add New Company</a></p>
        </div>
    </div>

    <div class="container my-2">
        <table class="table table-bordered data-table" id="datatable">
            <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Website</th>
                <th scope="col">show</th>
                <th scope="col">edit</th>
                <th scope="col">delete</th>
            </tr>
            </thead>
            <tbody>
            @foreach($companies as $company)
                <tr>
                    <td>{{$company->id}}</td>
                    <td>{{$company->name }}</td>
                    <td>{{$company->email}}</td>
                    <td>{{$company->website}}</td>
                    <td><a href="{{ route('Company.show', $company->id) }}" class="btn btn-info">Show</a></td>
                    <td><a href="{{ route('Company.edit', $company->id) }}" class="btn btn-success">Edit</a></td>
                    <td><a href="{{ route('Company.destroy', $company->id) }}" class="btn btn-danger">Edit</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection

@section('MyScripts')
    <script>
        $(document).ready(function () {
            $('#datatable').DataTable();
        });
    </script>
@endsection

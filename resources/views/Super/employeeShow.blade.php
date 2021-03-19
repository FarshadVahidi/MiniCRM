@extends('layouts.adminLte')

@section('mainContent')

    <div class="card-header border-0">
        <div class="d-flex justify-content-between">
            {{ __('Employee Detail:') }}
        </div>
    </div>

    <div class="container my-2">
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">Email</th>
                <th scope="col">Phone Number</th>
                <th scope="col">Company Work For</th>
                <th scope="col">Action</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>{{$employee->name}}</td>
                <td>{{$employee->lastName}}</td>
                <td>{{$employee->email}}</td>
                <td>{{$employee->phone}}</td>
                <td>{{$employee->company_name}}</td>
                <td>
                    <a href="{{route('User.edit', $employee->id)}}" class="btn btn-success">Edit</a>
                </td>
                <td>
                    <form method="POST" action="{{ route('User.destroy', $employee->id) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Are You Sure? you want to DELETE this user')"
                                class="btn btn-danger">Delete
                        </button>
                    </form>
                </td>
            </tr>
            </tbody>
        </table>

        @if($employee->photo)
            <div>
                <img src="{{asset('storage/uploads/' . $employee->photo)}}" class="img-thumbnail" alt="">
            </div>
        @endif
    </div>

@endsection

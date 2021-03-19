@extends('layouts.adminLte')

@section('mainContent')

    <div class="card-header border-0">
        <div class="d-flex justify-content-between">
            <p><a href="{{ route('User.create') }}" class="btn btn-primary">{{ __('Add New User') }}</a></p>
        </div>
    </div>

    <div class="container my-2">
        <table class="table table-bordered data-table" id="datatable">
            <thead>
            <tr>
                <th scope="col">{{ __('Id') }}</th>
                <th scope="col">{{ __('Name') }}</th>
                <th scope="col">{{ __('Email') }}</th>
                <th scope="col">{{ __('Phone') }}</th>
                <th scope="col">{{ __('Action') }}</th>
                <th scope="col">{{ __('Action') }}</th>
                <th scope="col">{{ __('Action') }}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($employees as $employee)
                <tr>
                    <td>{{$employee->id}}</td>
                    <td>{{$employee->name }}</td>
                    <td>{{$employee->email}}</td>
                    <td>{{$employee->phone}}</td>
                    <td><a href="{{ route('User.show', $employee->id) }}" class="btn btn-info">{{ __('Show') }}</a></td>
                    <td><a href="{{ route('User.edit', $employee->id) }}" class="btn btn-success">{{ __('Edit') }}</a></td>
                    <td>
                        <form method="POST" action="{{ route('User.destroy', $employee->id) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are You Sure? you want to DELETE this user')"
                                    class="btn btn-danger">{{ __('Delete') }}
                            </button>
                        </form>
                    </td>
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

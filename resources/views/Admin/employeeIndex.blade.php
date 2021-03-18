@extends('Admin.index')

@section('mainContent')
    <div class="py-6">
        <p><a href="{{ route('User.create') }}" class="btn btn-primary">Add New Employee</a></p>
    </div>

    <div class="container my-2">
        <table class="table table-bordered data-table" id="datatable">
            <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Phone</th>
                <th scope="col">Action</th>
                <th scope="col">Action</th>
                <th scope="col">Action</th>

            </tr>
            </thead>
            <tbody>
            @foreach($employees as $employee)
                <tr>
                    <td>{{$employee->id}}</td>
                    <td>{{$employee->name }}</td>
                    <td>{{$employee->email}}</td>
                    <td>{{$employee->phone}}</td>
                    <td><a href="{{ route('User.show', $employee->id) }}" class="btn btn-info">Show</a></td>
                    <td><a href="{{ route('User.edit', $employee->id) }}" class="btn btn-success">Edit</a></td>
                    <td>
                        <form method="POST" action="{{ route('User.destroy', $employee->id) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are You Sure? you want to DELETE this user')" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection
@section('myscript')
    <script>
        $(document).ready(function (){
            $('#datatable').DataTable();
        });
    </script>
@endsection

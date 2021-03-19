@extends('Admin.index')


@section('mainContent')

    <div class="py-6">
        <p><a href="{{ route('Company.create') }}" class="btn btn-primary">{{__('Add New Company')}}</a></p>
    </div>

    <div class="container my-2">
        <table class="table table-bordered data-table" id="datatable">
            <thead>
            <tr>
                <th scope="col">{{__('Id')}}</th>
                <th scope="col">{{__('Name')}}</th>
                <th scope="col">{{__('Email')}}</th>
                <th scope="col">{{__('Website')}}</th>
                <th scope="col">{{__('Action')}}</th>
                <th scope="col">{{__('Action')}}</th>

            </tr>
            </thead>
            <tbody>
            @foreach($companies as $company)
                <tr>
                    <td>{{$company->id}}</td>
                    <td>{{$company->name }}</td>
                    <td>{{$company->email}}</td>
                    <td>{{$company->website}}</td>
                    <td><a href="{{ route('Company.show', $company->id) }}" class="btn btn-info">{{__('Show')}}</a></td>
                    <td><a href="{{ route('Company.edit', $company->id) }}" class="btn btn-success">{{__('Edit')}}</a></td>
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



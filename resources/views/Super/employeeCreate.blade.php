@extends('layouts.adminLte')

@section('mainContent')

    <div class="container my-2">
        <form action="{{ route('User.store') }}" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">First Name</label>
                <input type="text" name="name" value="{{ old('name')}}" class="form-control">
                <div>{{$errors->first('name')}}</div>
            </div>

            <div class="form-group">
                <label for="lastName">Last Name</label>
                <input type="text" name="lastName" value="{{ old('lastName')}}" class="form-control">
                <div>{{$errors->first('lastName')}}</div>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" required="required" class="form-control">
                <div>{{$errors->first('password')}}</div>
            </div>

            <div class="form-group">
                <label for="password">Password Confirm</label>
                <input type="password" name="password_confirm" required="required" class="form-control">
                <div>{{$errors->first('password_confirm')}}</div>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" name="email" value="{{ old('email')}}" class="form-control">
                <div>{{ $errors->first('email') }}</div>
            </div>

            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" name="phone" value="{{ old('phone') }}" class="form-control">
                <div>{{ $errors->first('phone') }}</div>
            </div>

            <div class="mb-3">
                <label for="phone">Company List</label>
                <select class="form-text block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" name="company_id" required="required">
                    <option value="{{ old('company_id') }}" selected>Company List</option>
                    @foreach($companies as $company)
                        <option value="{{$company->id}}">{{$company->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="phone">Role List</label>
                <select
                    class="form-text block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                    name="role" required="required">
                    <option class="disabled">Select Role</option>
                    <option value="user">User</option>
                    <option value="administrator">Administrator</option>
                    <option value="superadministrator">Super Administrator</option>

                </select>
                {{ $errors->first('role') }}
            </div>

            <div class="form-group d-flex flex-column">
                <label for="photo">Photo</label>
                <input type="file" name="photo" class="py-2">
                <div>{{ $errors->first('photo') }}</div>
            </div>



            @csrf
            <button type="submit" class="btn btn-primary">Add Employee</button>
        </form>
    </div>
@endsection

@extends('layouts.adminLte')

@section('mainContent')

    <div class="container my-2">
        <form action="{{ route('User.store') }}" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">{{ __('First Name') }}</label>
                <input type="text" name="name" value="{{ old('name')}}" class="form-control">
                <div>{{$errors->first('name')}}</div>
            </div>

            <div class="form-group">
                <label for="lastName">{{ __('Last Name') }}</label>
                <input type="text" name="lastName" value="{{ old('lastName')}}" class="form-control">
                <div>{{$errors->first('lastName')}}</div>
            </div>

            <div class="form-group">
                <label for="password">{{ __('Password') }}</label>
                <input type="password" name="password" required="required" class="form-control">
                <div>{{$errors->first('password')}}</div>
            </div>

            <div class="form-group">
                <label for="password">{{ __('Password Confirm') }}</label>
                <input type="password" name="password_confirm" required="required" class="form-control">
                <div>{{$errors->first('password_confirm')}}</div>
            </div>

            <div class="form-group">
                <label for="email">{{ __('Email') }}</label>
                <input type="text" name="email" value="{{ old('email')}}" class="form-control">
                <div>{{ $errors->first('email') }}</div>
            </div>

            <div class="form-group">
                <label for="phone">{{ __('Phone') }}</label>
                <input type="text" name="phone" value="{{ old('phone') }}" class="form-control">
                <div>{{ $errors->first('phone') }}</div>
            </div>

            <div class="mb-3">
                <label for="phone">{{ __('Company List') }}</label>
                <select class="form-text block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" name="company_id" required="required">
                    <option value="{{ old('company_id') }}" selected>{{ __('Company List') }}</option>
                    @foreach($companies as $company)
                        <option value="{{$company->id}}">{{$company->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="phone">{{ __('Role List') }}</label>
                <select
                    class="form-text block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                    name="role" required="required">
                    <option class="disabled">{{ __('Select Role') }}</option>
                    <option value="user">{{ __('User') }}</option>
                    <option value="administrator">{{ __('Administrator') }}</option>
                    <option value="superadministrator">{{ __('Super Administrator') }}</option>

                </select>
                {{ $errors->first('role') }}
            </div>

            <div class="form-group d-flex flex-column">
                <label for="photo">{{ __('Photo') }}</label>
                <input type="file" name="photo" class="py-2">
                <div>{{ $errors->first('photo') }}</div>
            </div>



            @csrf
            <button type="submit" class="btn btn-primary">{{ __('Add New User') }}</button>
        </form>
    </div>
@endsection

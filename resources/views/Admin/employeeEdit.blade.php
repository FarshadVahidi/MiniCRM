@extends('Admin.index')

@section('headerContent')
    {{ __('Employee Detail:') }}
@endsection

@section('mainContent')
    <div class="row">
        <div class="col-md-12 offset-md-10">
            <form method="post" action="{{route('User.update', $employee->id)}}" enctype="multipart/form-data">
                @method('PATCH')
                <div class="form-group mb-3">
                    <label for="firstName" class="form-label">{{ __('First Name') }}</label>
                    <input type="text" name="name" class="form-control" required="required" value="{{ old('name') ?? $employee->name}}">
                    <div>{{ $errors->first('name') }}</div>
                </div>

                <div class="form-group mb-3">
                    <label for="lastName" class="form-label">{{ __('Last Name') }}</label>
                    <input type="text" name="lastName" class="form-control" required="required" value="{{ old('lastName') ?? $employee->lastName}}">
                    <div>{{ $errors->first('lastName') }}</div>
                </div>

                <div class="form-group mb-3">
                    <label for="email" class="form-label">{{ __('Email') }}</label>
                    <input type="text" name="email" class="form-control" required="required" value="{{ old('email') ?? $employee->email}}">
                    <div>{{ $errors->first('email') }}</div>
                </div>

                <div class=" form-group mb-3">
                    <label for="website" class="form-label">{{ __('Phone') }}</label>
                    <input type="text" name="phone" class="form-control" required="required" value="{{ old('phone') ?? $employee->phone}}">
                    <div>{{ $errors->first('phone') }}</div>
                </div>

                <div class="mb-3">
                    <select class="mdb-select" name="company_id">
                        <option value="{{ old('company_id') ?? $employee->company_id }}" selected>{{ $employee->company_name }}</option>
                        @foreach($companies as $company)
                            <option value="{{$company->id}}">{{$company->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group d-flex flex-column">
                    <label for="photo" class="py-2">{{ __('Image') }}</label>
                    <input type="file" name="photo" class="py-2" value="{{ old('photo') ?? $employee->photo }}">
                    <div>{{ $errors->first('photo') }}</div>
                </div>

                @csrf
                <button type="submit" class="btn btn-primary">{{ __('Update User Profile') }}</button>
            </form>
        </div>
    </div>
@endsection

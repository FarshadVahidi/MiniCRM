@extends('Admin.index')

@section('headerContent')
    {{ __('Administrator Detail:') }}
@endsection

@section('mainContent')
    <div class="row">
        <div class="col-md-12 offset-md-10">
            <form method="post" action="{{route('User.update', $employee->id)}}" enctype="multipart/form-data">
                @method('PATCH')
                <div class="form-group mb-3">
                    <label for="firstName" class="form-label">FIRST Name</label>
                    <input type="text" name="name" class="form-control" required="required" value="{{ old('name') ?? $employee->name}}">
                    <div>{{ $errors->first('name') }}</div>
                </div>

                <div class="form-group mb-3">
                    <label for="lastName" class="form-label">FIRST Name</label>
                    <input type="text" name="lastName" class="form-control" required="required" value="{{ old('lastName') ?? $employee->lastName}}">
                    <div>{{ $errors->first('lastName') }}</div>
                </div>

                <div class="form-group mb-3">
                    <label for="email" class="form-label">EMAIL</label>
                    <input type="text" name="email" class="form-control" required="required" value="{{ old('email') ?? $employee->email}}">
                    <div>{{ $errors->first('email') }}</div>
                </div>

                <div class=" form-group mb-3">
                    <label for="website" class="form-label">PHONE</label>
                    <input type="text" name="phone" class="form-control" required="required" value="{{ old('phone') ?? $employee->phone}}">
                </div>

                <div class="form-group d-flex flex-column">
                    <label for="photo" class="py-2">IMAGE</label>
                    <input type="file" name="photo" class="py-2" value="{{ old('photo') ?? $employee->photo }}">
                    <div>{{ $errors->first('photo') }}</div>
                </div>

                <div class="form-group d-flex flex-column">
                    <input type="text" name="company_name" hidden value="{{$employee->company_name}}">
                </div>

                <div class="form-group d-flex fles-column">
                    <input type="number" name="company_id" hidden value="{{$employee->company_id}}">
                </div>

                @csrf
                <button type="submit" class="btn btn-primary">Update My Info</button>
            </form>
        </div>
    </div>
@endsection

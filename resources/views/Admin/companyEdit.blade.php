@extends('Admin.index')

@section('mainContent')
    <div class="row">
        <div class="col-md-12 offset-md-3">
            <form method="post" action="{{route('Company.update', $company->id)}}" enctype="multipart/form-data">
                @method('PATCH')
                <div class="form-group mb-3">
                    <label for="name" class="form-label">{{__('Name')}}/label>
                    <input type="text" name="name" class="form-control" required="required" value="{{ old('name') ?? $company->name}}">
                    <div>{{ $errors->first('name') }}</div>
                </div>

                <div class="form-group mb-3">
                    <label for="email" class="form-label">{{__('Email')}}</label>
                    <input type="text" name="email" class="form-control" required="required" value="{{ old('email') ?? $company->email}}">
                    <div>{{ $errors->first('email') }}</div>
                </div>

                <div class=" form-group mb-3">
                    <label for="website" class="form-label">{{__('Website')}}</label>
                    <input type="text" name="website"  required="required "class="form-control"
                           value="{{ old('website') ?? $company->website}}">
                    <div>{{$errors->first('website')}}</div>
                </div>

                <div class="form-group d-flex flex-column">
                    <label for="image">{{__('Logo')}}</label>
                    <input type="file" name="image" class="py-2">
                    <div>{{ $errors->first('image') }}</div>
                </div>
                @csrf
                <button type="submit" class="btn btn-primary">{{__('Update Company Profile')}}</button>
            </form>
        </div>
    </div>

@endsection

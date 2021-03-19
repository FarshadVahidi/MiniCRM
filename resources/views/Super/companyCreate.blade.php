@extends('Super.index')

@section('mainContent')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="container my-2">
                    <form action="{{ route('Company.store') }}" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" value="{{ old('name')}}" class="form-control">
                            <div>{{$errors->first('name')}}</div>
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" name="email" value="{{ old('email')}}" class="form-control">
                            <div>{{ $errors->first('email') }}</div>
                        </div>

                        <div class="form-group">
                            <label for="email">Website</label>
                            <input type="text" name="website" value="{{ old('website') }}" class="form-control">
                            <div>{{ $errors->first('email') }}</div>
                        </div>

                        <div class="form-group d-flex flex-column">
                            <label for="image">Logo</label>
                            <input type="file" name="image" class="py-2">
                            <div>{{ $errors->first('image') }}</div>
                        </div>

                        @csrf
                        <button type="submit" class="btn btn-primary">Add Company</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

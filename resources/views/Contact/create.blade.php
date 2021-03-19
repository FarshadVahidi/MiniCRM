@extends('User.index')

@section('headerContent')
    <div class="row">
        <div class="col-12">
            <h4>Contact Us</h4>
        </div>
    </div>
@endsection

@section('mainContent')

    <div class="row">
        <div class="col-12 offset-md-6">
            <form action="{{ route('Contact.store') }}" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" value="{{ old('name')}}" required="required" class="form-control">
                    <div>{{$errors->first('name')}}</div>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" name="email" value="{{ old('email')}}" required="required" class="form-control">
                    <div>{{ $errors->first('email') }}</div>
                </div>

                <div class="form-group">
                    <label for="email">Website</label>
                    <input type="text" name="website" value="{{ old('website') }}" class="form-control">
                    <div>{{ $errors->first('website') }}</div>
                </div>

                <div class="form-group">
                    <label for="image">Message</label>
                    <textarea type="file" name="message" class="form-control" required="required" cols="30"
                              rows="6">{{ old('message') }}</textarea>
                    <div>{{ $errors->first('message') }}</div>
                </div>

                @csrf
                <button type="submit" class="btn btn-primary my-6">Send Email</button>
            </form>
        </div>
    </div>

@endsection

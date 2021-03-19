@extends('User.index')

@section('headerContent')
    {{ __('Employee Detail:') }}
@endsection

@section('mainContent')
    <div class="row">
        <div class="col-md-12 offset-md-3">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">{{ __('First Name') }}</th>
                    <th scope="col">{{ __('Last Name') }}</th>
                    <th scope="col">{{ __('Email') }}</th>
                    <th scope="col">{{ __('Phone Number') }}</th>
                    <th scope="col">{{ __('Company Work For') }}</th>
                    <th scope="col">{{ __('Action') }}</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>{{$user->name}}</td>
                    <td>{{$user->lastName}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->phone}}</td>
                    <td>{{$user->company_name}}</td>
                    <td>
                        <a href="{{route('User.edit', $user)}}" class="btn btn-info">{{ __('Edit') }}</a>
                    </td>
                </tr>
                </tbody>
            </table>

            @if($user->photo)
                <div>
                    <img src="{{asset('storage/uploads/' . $user->photo)}}" class="img-thumbnail" alt="">
                </div>
            @endif
        </div>
    </div>
@endsection

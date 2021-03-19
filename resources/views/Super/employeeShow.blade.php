@extends('layouts.adminLte')

@section('mainContent')

    <div class="card-header border-0">
        <div class="d-flex justify-content-between">
            {{ __('Employee Detail:') }}
        </div>
    </div>

    <div class="container my-2">
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">{{ __('First Name') }}</th>
                <th scope="col">{{ __('Last Name') }}</th>
                <th scope="col">{{ __('Email') }}</th>
                <th scope="col">{{ __('Phone Number') }}</th>
                <th scope="col">{{ __('Work For') }}</th>
                <th scope="col">{{ __('Action') }}</th>
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
                    <a href="{{route('User.edit', $user->id)}}" class="btn btn-success">{{ __('Edit') }}</a>
                </td>
                <td>
                    <form method="POST" action="{{ route('User.destroy', $user->id) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Are You Sure? you want to DELETE this user')"
                                class="btn btn-danger">{{ __('Delete') }}
                        </button>
                    </form>
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

@endsection

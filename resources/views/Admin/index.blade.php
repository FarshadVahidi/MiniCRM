<x-app-layout>

    @section('headerContent')
        <div class="row">
            @if(Session::has('message'))
                <div class="alert alert-success" role="alert">
                    {{Session::get('message')}}
                </div>
            @endif
        </div>
    @endsection

    @section('nav')
        <x-jet-nav-link href="{{ route('Company.show', auth()->user()->company_id) }}">
            {{ __('Company Info') }}
        </x-jet-nav-link>

        <x-jet-nav-link href="{{ route('User.show', auth()->user()->id) }}">
            {{ __('My Info') }}
        </x-jet-nav-link>

        <x-jet-nav-link href="{{ route('User.index') }}">
            {{ __('Company List') }}
        </x-jet-nav-link>

        <x-jet-nav-link href="{{ route('User.index') }}">
            {{ __('Employee List') }}
        </x-jet-nav-link>
    @endsection


</x-app-layout>

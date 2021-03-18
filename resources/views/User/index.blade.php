<x-app-layout>
    @section('nav')
        <x-jet-nav-link href="{{ route('Company.index') }}">
            {{ __('Company') }}
        </x-jet-nav-link>

        <x-jet-nav-link href="{{ route('User.index') }}">
            {{ __('My Info') }}
        </x-jet-nav-link>
    @endsection
</x-app-layout>

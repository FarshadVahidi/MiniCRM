<x-app-layout>
    @section('nav')
        <x-jet-nav-link href="{{ route('Company.show') }}">
            {{ __('Company Info') }}
        </x-jet-nav-link>

        <x-jet-nav-link href="{{ route('User.show') }}">
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

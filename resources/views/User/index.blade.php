<x-app-layout>

    @section('nav')
        <x-jet-nav-link href="{{ route('Company.show', auth()->user()->company_id) }}">
            {{ __('Company Info') }}
        </x-jet-nav-link>

        <x-jet-nav-link href="{{ route('User.show', auth()->user()->id) }}">
            {{ __('My Info') }}
        </x-jet-nav-link>
    @endsection


            @section('headerContent')
            @if(Session::has('message'))
                <div class="alert alert-success" role="alert">
                {{Session::get('message')}}
                </div>
            @endif
            @endsection

</x-app-layout>

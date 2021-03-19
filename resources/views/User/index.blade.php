<x-app-layout>

    @section('nav')
        <x-jet-nav-link href="{{ route('Company.show', auth()->user()->company_id) }}">
            {{ __('Company Info') }}
        </x-jet-nav-link>

        <x-jet-nav-link href="{{ route('User.show', auth()->user()->id) }}">
            {{ __('My Info') }}
        </x-jet-nav-link>

        <x-jet-nav-link href="{{ route('Contact.create') }}">
            {{ __('Contact Us') }}
        </x-jet-nav-link>

        <!-- Right Side Of Navbar -->
        <ul class="navbar-nav ml-auto">
            @if(count(config('app.languages')) > 1)
                <li class="nav-item dropdown d-md-down-none">
                    <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                        {{ strtoupper(app()->getLocale()) }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        @foreach(config('app.languages') as $langLocale => $langName)
                            <a class="dropdown-item" href="{{ url()->current() }}?change_language={{ $langLocale }}">{{ strtoupper($langLocale) }} ({{ $langName }})</a>
                        @endforeach
                    </div>
                </li>
            @endif
    @endsection


            @section('headerContent')
            @if(Session::has('message'))
                <div class="alert alert-success" role="alert">
                {{Session::get('message')}}
                </div>
            @endif
            @endsection

</x-app-layout>

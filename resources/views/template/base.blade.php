@extends('template.simple_page')

@section('main')
    <main class="container mx-auto mt-3">
        <div class="px-3 py-4 bg-white shadow-md rounded-lg">
            @yield('content')
        </div>
    </main>
@endsection

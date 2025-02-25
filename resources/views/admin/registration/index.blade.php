@extends('layouts.app')

@include('layouts.sidebar')

@section('content')
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Inscrições nos Eventos</h1>

        <div class="overflow-x-auto bg-white shadow-lg rounded-lg">
            <table class="w-full border border-gray-200">
                <thead>
                    <tr class="bg-gray-100 text-gray-700 uppercase text-sm leading-normal">
                        <th class="px-6 py-3 text-left">Evento</th>
                        <th class="px-6 py-3 text-left">Participante</th>
                        <th class="px-6 py-3 text-left">Data da Inscrição</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm">
                    @foreach ($registrations as $registration)
                        <tr class="border-b border-gray-200 hover:bg-gray-50">
                            <td class="px-6 py-4">{{ $registration->event->title }}</td>
                            <td class="px-6 py-4">{{ $registration->user->name }}</td>
                            <td class="px-6 py-4">{{ $registration->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

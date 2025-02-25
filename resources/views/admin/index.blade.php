@extends('layouts.app')
@extends('layouts.sidebar')

@section('content')
    <div class="flex h-screen py-8 bg-gray-900 text-gray-200">
        <main class="flex-1 p-6">

            <div class="flex justify-between items-center">
                <h2 class="text-2xl font-semibold text-white">Olá, {{ Auth::user()->name }}</h2>
                <button class="bg-blue-600 px-4 py-2 rounded text-white">Novo Evento</button>
            </div>

            <div class="mt-6 bg-gray-800 rounded-lg p-4">
                <h3 class="text-lg font-semibold text-white">Recent orders</h3>
                <table class="w-full mt-4 text-sm">
                    <thead class="text-gray-400 border-b border-gray-700">
                        <tr>
                            <th class="py-2 text-left text-white">Título</th>
                            <th class="py-2 text-left text-white">Data</th>
                            <th class="py-2 text-left text-white">Status</th>
                            <th class="py-2 text-left text-white">Ações</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($events as $event)
                            <tr class="border-b border-gray-700">
                                <td class="py-2 text-white">{{ $event->id }}</td>
                                <td class="py-2 text-white">
                                    {{ \Carbon\Carbon::parse($event->start_datetime)->format('M d, Y') }}
                                </td>
                                <td class="py-2 text-white">
                                    <span
                                        class="inline-block px-2 py-1 text-sm font-semibold bg-{{ $event->status == 'open' ? 'green' : ($event->status == 'closed' ? 'red' : 'yellow') }}-500 text-white rounded">
                                        {{ ucfirst($event->status) }}
                                    </span>
                                </td>

                                <td class="py-2 ">
                                    <form action="{{ route('events.destroy', $event->id) }}" method="POST"
                                        class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800">Excluir</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </main>
    </div>
@endsection

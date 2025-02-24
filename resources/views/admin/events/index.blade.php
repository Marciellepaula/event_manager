@extends('layouts.app')

@section('content')
    <div class="max-w-6xl mx-auto py-6">
        <h1 class="text-3xl font-bold mb-4">Eventos</h1>

        <a href="{{ route('events.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Criar Novo Evento</a>

        <table class="w-full mt-4 bg-white shadow-md rounded-lg overflow-hidden">
            <thead class="bg-gray-200">
                <tr>
                    <th class="px-4 py-2">Título</th>
                    <th class="px-4 py-2">Data</th>
                    <th class="px-4 py-2">Local</th>
                    <th class="px-4 py-2">Capacidade</th>
                    <th class="px-4 py-2">Status</th>
                    <th class="px-4 py-2">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($events as $event)
                    <tr class="border-b">
                        <td class="px-4 py-2">{{ $event->title }}</td>
                        <td class="px-4 py-2">{{ $event->start_date->format('d/m/Y H:i') }}</td>
                        <td class="px-4 py-2">{{ $event->location }}</td>
                        <td class="px-4 py-2">{{ $event->capacity }}</td>
                        <td class="px-4 py-2">{{ ucfirst($event->status) }}</td>
                        <td class="px-4 py-2 flex gap-2">
                            <a href="{{ route('events.edit', $event->id) }}"
                                class="bg-yellow-500 text-white px-2 py-1 rounded">Editar</a>
                            <form action="{{ route('events.destroy', $event->id) }}" method="POST">
                                @csrf @method('DELETE')
                                <button class="bg-red-500 text-white px-2 py-1 rounded"
                                    onclick="return confirm('Deseja excluir?')">Excluir</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

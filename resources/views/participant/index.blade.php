@extends('layouts.app')
@extends('layouts.app')

@section('content')
    <div class="max-w-6xl mx-auto py-6 px-4">
        <h1 class="text-3xl font-bold mb-4">Eventos Disponíveis</h1>

        @if ($events->isEmpty())
            <p class="text-gray-600">Nenhum evento disponível no momento.</p>
        @else
            <div class="overflow-x-auto">
                <table class="w-full mt-4 bg-white shadow-md rounded-lg">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="px-4 py-2 text-left">Título</th>
                            <th class="px-4 py-2 text-left">Data</th>
                            <th class="px-4 py-2 text-left">Local</th>
                            <th class="px-4 py-2 text-left">Capacidade</th>
                            <th class="px-4 py-2 text-left">Status</th>
                            <th class="px-4 py-2 text-left">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($events as $event)
                            <tr class="border-b">
                                <td class="px-4 py-2">{{ $event->title }}</td>
                                <td class="px-4 py-2">
                                    {{ \Carbon\Carbon::parse($event->start_datetime)->format('d/m/Y H:i') }}</td>
                                <td class="px-4 py-2">{{ $event->location }}</td>
                                <td class="px-4 py-2">{{ $event->max_capacity }}</td>
                                <td class="px-4 py-2">
                                    <span
                                        class="px-2 py-1 rounded {{ $event->status == 'open' ? 'bg-green-500 text-white' : 'bg-red-500 text-white' }}">
                                        {{ ucfirst($event->status) }}
                                    </span>
                                </td>
                                <td class="px-4 py-2">
                                    @if ($event->status === 'open' && $event->registrations()->count() < $event->max_capacity)
                                        <form action="{{ route('inscricoes.inscrever', $event->id) }}" method="POST"
                                            class="inline-block">
                                            @csrf
                                            <button type="submit"
                                                class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                                                Inscrever-se
                                            </button>
                                        </form>
                                    @endif

                                    @if (auth()->user()->registrations->contains('event_id', $event->id))
                                        <form action="{{ route('inscricoes.cancelar', $event->id) }}" method="POST"
                                            class="inline-block">
                                            @csrf
                                            <button type="submit"
                                                class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                                                Cancelar Inscrição
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection

@extends('layouts.app')

@section('content')
    <div class="flex h-screen py-8 text-gray-200">
        <main class="flex-1 p-6">
            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                <div class="px-4 py-5 sm:px-6 flex justify-between items-center">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Eventos Disponíveis</h3>
                </div>

                <div class="border-t border-gray-200">
                    @if ($events->isEmpty())
                        <div class="p-6 text-center text-gray-600">
                            Nenhum evento disponível no momento.
                        </div>
                    @else
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Título</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Data Início</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Data Final</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Local</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Capacidade</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status</th>
                                    <th
                                        class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Ações</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($events as $event)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            {{ $event->title }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ \Carbon\Carbon::parse($event->start_datetime)->format('d/m/Y H:i') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ \Carbon\Carbon::parse($event->end_datetime)->format('d/m/Y H:i') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $event->location }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $event->max_capacity }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $event->status == 'open' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                {{ ucfirst($event->status) }}
                                            </span>
                                        </td>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm font-medium text-center flex justify-center space-x-2">
                                            @if (
                                                $event->status === 'open' &&
                                                    $event->registrations()->count() < $event->max_capacity &&
                                                    auth()->user()->registrations()->where('event_id', $event->id)->doesntExist())
                                                <form action="{{ route('inscricoes.inscrever', $event->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    <button type="submit"
                                                        class="bg-blue-600 text-white px-4 py-2 rounded shadow-md hover:bg-blue-700">Inscrever</button>
                                                </form>
                                            @endif
                                            @if (auth()->user()->registrations->contains('event_id', $event->id))
                                                <form action="{{ route('inscricoes.cancelar', $event->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    <button type="submit"
                                                        class="bg-red-600 text-white px-4 py-2 rounded shadow-md hover:bg-red-700">Cancelar</button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="p-4 !bg-white">
                            {{ $events->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </main>
    </div>
@endsection

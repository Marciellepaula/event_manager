@extends('layouts.app')

@section('content')
    <div class="flex h-screen py-8  text-gray-200">
        <main class="flex-1 p-6">
            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                <div class="px-4 py-5 sm:px-6 flex justify-between items-center">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Eventos</h3>

                    <div class="flex space-x-4">
                        <select class="border text-gray-900  rounded px-5 py-2">
                            <option class = "text-gray-900" value="all">Todos</option>
                            <option class = "text-gray-900" value="active">Ativos</option>
                            <option class = "text-gray-900" value="inactive">Inativos</option>
                        </select>
                        <input type="date" class="border text-gray-900 rounded px-2 py-1" />
                    </div>
                    <a href="{{ route('events.create') }}" class="bg-blue-600 px-4 py-2 rounded text-white">Novo Evento</a>
                </div>

                <div class="border-t border-gray-200">
                    @if ($events->count())
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Nome do Evento</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Data</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Ações</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($events as $event)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            {{ $event->title }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ \Carbon\Carbon::parse($event->start_datetime)->format('M d, Y') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                            {{ $event->status == 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                {{ ucfirst($event->status) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <a href="{{ route('events.edit', $event->id) }}"
                                                class="text-indigo-600 hover:text-indigo-900">Editar</a>
                                            <form action="{{ route('events.destroy', $event->id) }}" method="POST"
                                                class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="text-red-600 hover:text-red-900 ml-4">Excluir</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="p-4">
                            {{ $events->links() }}
                        </div>
                    @else
                        <div class="p-6 text-center text-gray-600">
                            Nenhum evento encontrado.
                        </div>
                    @endif
                </div>
            </div>
        </main>
    </div>
@endsection

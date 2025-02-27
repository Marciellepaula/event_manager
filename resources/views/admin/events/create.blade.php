@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Criar Evento</h1>

        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <form action="{{ route('events.store') }}" method="POST">
                @csrf
                <div class="px-4 py-5 sm:px-6">
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Título</label>
                        <input type="text" name="title"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-gray-900 focus:ring-indigo-500 focus:border-indigo-500"
                            required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Descrição</label>
                        <textarea name="description"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-gray-900 focus:ring-indigo-500 focus:border-indigo-500"></textarea>
                    </div>

                    <div class="flex gap-4">
                        <div class="w-full">
                            <label class="block text-sm font-medium text-gray-700">Data Início</label>
                            <input type="datetime-local" name="start_datetime"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-gray-900 focus:ring-indigo-500 focus:border-indigo-500"
                                required>
                        </div>
                        <div class="w-full">
                            <label class="block text-sm font-medium text-gray-700">Data Fim</label>
                            <input type="datetime-local" name="end_datetime"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-gray-900 focus:ring-indigo-500 focus:border-indigo-500"
                                required>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Capacidade Máxima</label>
                        <input type="number" name="max_capacity"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-gray-900 focus:ring-indigo-500 focus:border-indigo-500"
                            required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Localização</label>
                        <input type="text" name="location"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-gray-900 focus:ring-indigo-500 focus:border-indigo-500"
                            required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Status</label>
                        <select name="status"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-gray-900 focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="open">Aberto</option>
                            <option value="closed">Fechado</option>
                            <option value="canceled">Cancelado</option>
                        </select>
                    </div>

                    <div class="mt-6 text-right">
                        <button type="submit"
                            class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">Salvar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

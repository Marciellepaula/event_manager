@extends('layouts.app')

@include('layouts.sidebar')

@section('content')
    <div class="max-w-4xl mx-auto p-6 bg-white shadow-lg rounded-lg">
        <h2 class="text-xl font-bold mb-4">Editar Evento</h2>

        <form action="{{ route('events.update', $event->id) }}" method="POST">
            @csrf
            @method('PUT')

            <label class="block mb-2">Título</label>
            <input type="text" name="title" value="{{ $event->title }}" class="w-full px-4 py-2 border rounded-lg mb-4"
                required>

            <label class="block mb-2">Descrição</label>
            <textarea name="description" class="w-full px-4 py-2 border rounded-lg mb-4" required>{{ $event->description }}</textarea>

            <label class="block mb-2">Data de Início</label>
            <input type="datetime-local" name="start_datetime" value="{{ $event->start_datetime }}"
                class="w-full px-4 py-2 border rounded-lg mb-4" required>

            <label class="block mb-2">Data de Término</label>
            <input type="datetime-local" name="end_datetime" value="{{ $event->end_datetime }}"
                class="w-full px-4 py-2 border rounded-lg mb-4" required>

            <label class="block mb-2">Localização</label>
            <input type="text" name="location" value="{{ $event->location }}"
                class="w-full px-4 py-2 border rounded-lg mb-4" required>

            <label class="block mb-2">Capacidade Máxima</label>
            <input type="number" name="max_capacity" value="{{ $event->max_capacity }}"
                class="w-full px-4 py-2 border rounded-lg mb-4" required>

            <label class="block mb-2">Status</label>
            <select name="status" class="w-full px-4 py-2 border rounded-lg mb-4">
                <option value="open" {{ $event->status == 'open' ? 'selected' : '' }}>Aberto</option>
                <option value="closed" {{ $event->status == 'closed' ? 'selected' : '' }}>Fechado</option>
                <option value="canceled" {{ $event->status == 'canceled' ? 'selected' : '' }}>Cancelado</option>
            </select>

            <button type="submit" class="w-full px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                Atualizar Evento
            </button>
        </form>
    </div>
@endsection

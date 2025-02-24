@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto py-6">
        <h1 class="text-2xl font-bold mb-4">Criar Evento</h1>

        <form action="{{ route('events.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block">Título</label>
                <input type="text" name="title" class="w-full border rounded px-3 py-2">
            </div>

            <div class="mb-4">
                <label class="block">Descrição</label>
                <textarea name="description" class="w-full border rounded px-3 py-2"></textarea>
            </div>

            <div class="flex gap-4">
                <div>
                    <label class="block">Data Início</label>
                    <input type="datetime-local" name="start_date" class="border rounded px-3 py-2">
                </div>
                <div>
                    <label class="block">Data Fim</label>
                    <input type="datetime-local" name="end_date" class="border rounded px-3 py-2">
                </div>
            </div>

            <div class="mt-4">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Salvar</button>
            </div>
        </form>
    </div>
@endsection

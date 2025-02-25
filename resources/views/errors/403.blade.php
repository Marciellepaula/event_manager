@extends('template.initial')

@section('titulo', 'Proibido')

@section('main')
    <div class="flex items-center justify-center min-h-screen bg-gray-100">
        <div class="bg-white shadow-lg rounded-lg p-8 text-center">
            <h1 class="text-4xl font-extrabold text-red-600">Proibido!</h1>
            <h3 class="text-xl text-gray-700 mt-4">Você não tem Permissão para acessar esse conteúdo!</h3>
            <a class="mt-6 inline-block bg-blue-500 text-white font-semibold py-2 px-4 rounded hover:bg-blue-600"
                href="{{ route('inscricoes.index') }}">Início</a>
        </div>
    </div>
@endsection

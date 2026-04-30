@extends('admin.layouts.app')

@section('title', 'Editar Usuário')

@section('content')
    <header class="bg-white dark:bg-gray-800 shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            @include('admin.users.partials.breadcrumb')
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Editar Usuário
            </h2>
        </div>
    </header>
    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @method("PUT")
        @include('admin.users.partials.form')
    </form>
    
@endsection
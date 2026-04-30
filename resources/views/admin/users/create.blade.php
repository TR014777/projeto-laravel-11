@extends('admin.layouts.app')

@section('title', 'Novo Usuário')

@section('content')

<header class="bg-white dark:bg-gray-800 shadow">
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        @include('admin.users.partials.breadcrumb')
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Novo Usuário
        </h2>
    </div>
</header>
<form action="{{ route('users.store') }}" method="POST">
    @include('admin.users.partials.form')
</form>

@endsection
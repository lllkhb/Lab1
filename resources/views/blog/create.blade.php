@extends('layouts.app')
@section('title', 'Створення запису')

@section('content')
    <h1>Новий запис</h1>

    <form action="{{ route('blog.store') }}" method="POST">
        @csrf

        @include('blog._form')

        <button type="submit">Створити</button>
    </form>
@endsection

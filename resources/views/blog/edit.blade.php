@extends('layouts.app')
@section('title', 'Редагування запису')

@section('content')
    <h1>Редагування запису</h1>

    <form action="{{ route('blog.update', $blog) }}" method="POST">
        @csrf
        @method('PUT')

        @include('blog._form')

        <button type="submit">Зберегти зміни</button>
    </form>
@endsection

@extends('layouts.app')
@section('title', 'Блог')
@section('content')
    <h1>Блог</h1>
    <nav class="blog-filters">
        <a href="{{ route('blog.index') }}">
            Усі записи
        </a>
        @foreach ($filters as $id => $name)
            <a href="{{ route('blog.index', ['filter' => $id]) }}">
                {{ $name }}
            </a>
        @endforeach
    </nav>
    <div class="blog-grid">
        @forelse ($blogs as $blog)
            @include('blog._item', ['blog' => $blog])
        @empty
            <p>Записів поки немає.</p>
        @endforelse
    </div>
    {{ $blogs->links() }}
@endsection

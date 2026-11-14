@extends('layouts.app')
@section('title', $blog->title)

@section('content')
    <article>
        <h1>{{ $blog->title }}</h1>

        <div style="color: #555; margin-bottom: 20px;">
            <strong>Категорія:</strong> {{ $blog->category?->category_name ?? 'Без категорії' }} |
            <strong>Автор:</strong> {{ $blog->author?->name ?? 'Редакція' }} |
            <strong>Дата публікації:</strong> {{ $blog->dt_created->format('d.m.Y') }}
        </div>

        <div style="line-height: 1.6;">
            {{ $blog->text }}
        </div>
    </article>

    <div style="margin-top: 20px;">
        <a href="{{ route('blog.index') }}">Повернутися назад</a>
        <a href="{{ route('blog.edit', $blog) }}" style="margin-left: 15px;">Редагувати</a>
    </div>

    <div class="tags">
        @forelse ($blog->filters as $filter)
            <span class="tag">
            {{ $filter->filter_name }}
            </span>
        @empty
            <span>Міток немає.</span>
        @endforelse
    </div>
@endsection

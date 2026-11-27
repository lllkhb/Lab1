@extends('layouts.app')

@section('title', 'Редагування мітки')

@section('content')
    <h1>Редагування мітки</h1>
    <a href="{{ route('filters.index') }}">← Назад до списку</a>

    <form action="{{ route('filters.update', $filter) }}" method="POST">
        @csrf
        @method('PUT')

        <div style="margin-bottom: 15px;">
            <label for="filter_name">Назва мітки:</label><br>
            <input type="text" name="filter_name" id="filter_name" value="{{ old('filter_name', $filter->filter_name) }}" required>

            @error('filter_name')
            <div style="color: red; font-size: 0.9em;">{{ $message }}</div>
            @enderror
        </div>

        <div style="margin-bottom: 15px;">
            <label for="filter_description">Опис мітки (необов'язково):</label><br>
            <textarea name="filter_description" id="filter_description">{{ old('filter_description', $filter->filter_description) }}</textarea>

            @error('filter_description')
            <div style="color: red; font-size: 0.9em;">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit">Оновити мітку</button>
    </form>
@endsection

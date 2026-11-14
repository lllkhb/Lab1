@extends('layouts.app')

@section('title', 'Створення мітки')

@section('content')
    <h1>Нова мітка</h1>
    <a href="{{ route('filters.index') }}">← Назад до списку</a>

    <form action="{{ route('filters.store') }}" method="POST">
        @csrf

        <div style="margin-bottom: 15px;">
            <label for="filter_name">Назва мітки:</label><br>
            <input type="text" name="filter_name" id="filter_name" value="{{ old('filter_name') }}" required>

            @error('filter_name')
            <div style="color: red; font-size: 0.9em;">{{ $message }}</div>
            @enderror
        </div>

        <div style="margin-bottom: 15px;">
            <label for="filter_description">Опис мітки (необов'язково):</label><br>
            <textarea name="filter_description" id="filter_description">{{ old('filter_description') }}</textarea>

            @error('filter_description')
            <div style="color: red; font-size: 0.9em;">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit">Зберегти мітку</button>
    </form>
@endsection

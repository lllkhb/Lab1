@extends('layouts.app')
@section('title', 'Керування мітками')
@section('content')
    <h1>Мітки: {{ $blog->title }}</h1>
    <form method="POST"
          action="{{ route('blog.tags.store', $blog) }}">
        @csrf
        <label for="duallist">
            Оберіть мітки запису
        </label>
        <select
            id="duallist"
            name="filters[]"
            multiple
        >
            @foreach ($filters as $id => $name)
                <option
                    value="{{ $id }}"
                    @selected(
                    in_array(
                    $id,
                    old('filters', $selected)
                    )
                    )
                >
                    {{ $name }}
                </option>
            @endforeach
        </select>
        <button type="submit">Зберегти мітки
        </button>
    </form>
@endsection

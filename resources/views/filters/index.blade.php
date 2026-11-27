@extends('layouts.app')

@section('title', 'Довідник міток')

@section('content')
    <h1>Довідник міток</h1>
    <p>
        <a href="{{ route('filters.create') }}">+ Додати мітку</a>
    </p>

    <hr>

    @forelse($filters as $filter)
        <div style="margin-bottom: 20px; padding-bottom: 10px; border-bottom: 1px solid #eee;">
            <h2>{{ $filter->filter_name }}</h2>

            @if($filter->filter_description)
                <p>{{ $filter->filter_description }}</p>
            @endif

            <div style="display: flex; gap: 15px; align-items: center;">
                <a href="{{ route('filters.edit', $filter) }}" style="background-color: #1c3c5a; color: white; padding: 8px 16px; border-radius: 4px; text-decoration: none; font-weight: bold; font-size: 14px;">
                    Редагувати
                </a>

                <form action="{{ route('filters.destroy', $filter) }}" method="POST" onsubmit="return confirm('Ви дійсно бажаєте видалити цю мітку?');" style="margin: 0;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" style="background-color: #dc3545; color: white; border: none; padding: 8px 16px; border-radius: 4px; font-weight: bold; font-size: 14px; cursor: pointer;">
                        Видалити
                    </button>
                </form>
            </div>
        </div>
    @empty
        <p>Міток поки не додано</p>
    @endforelse
@endsection

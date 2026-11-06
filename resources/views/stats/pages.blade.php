@extends('layouts.app')
@section('title', 'Статистика відвідувань')
@section('content')<h1>Статистика відвідувань</h1>
<p>
    <a href="{{ route('stats.pages', ['type' => 'page']) }}">
        За сторінками
    </a>
    <a href="{{ route('stats.pages', ['type' => 'ip']) }}">
        За IP-адресами
    </a>
</p>
<table>
    <thead>
    <tr>
        <th>{{ $type === 'page' ? 'Сторінка' : 'IP-адреса' }}</th>
        <th>Звернень</th>
        <th>Останній візит</th>
    </tr>
    </thead>
    <tbody>
    @forelse ($rows as $row)
        <tr>
            <td>
                <a href="{{ route('stats.detail', [
'type' => $type,
'item' => $row->{$type},
]) }}">
                    {{ $row->{$type} }}
                </a>
            </td>
            <td>{{ $row->hits }}</td>
            <td>{{ $row->last_visit }}</td>
        </tr>
    @empty
        <tr>
            <td colspan="3">
                Даних ще немає.
            </td>
        </tr>@endforelse
    </tbody>
</table>
@endsection

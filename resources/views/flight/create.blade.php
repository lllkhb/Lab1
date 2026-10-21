@extends('layouts.app')
@section('title', 'Додати рейс')
@section('content')
    <h1>Додати рейс</h1>
    <form method="POST" action="{{ route('flight.store') }}">
        @csrf
        @include('flight._form')
        <button type="submit">Зберегти</button>
    </form>
@endsection

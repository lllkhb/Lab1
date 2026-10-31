@extends('layouts.app')
@section('title', 'Редагування рейсу')
@section('content')
    <h1>Редагування рейсу {{ $flight->id }}</h1>
    <form method="POST" action="{{ route('flight.update', $flight) }}">
        @csrf
        @method('PUT')
        @include('flight._form')
        <button type="submit">Зберегти зміни</button>
    </form>
@endsection

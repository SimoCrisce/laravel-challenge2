@extends('template.base')

@section('title', 'Il mio profilo')

@section('content')
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Nome</th>
                <th scope="col">Email</th>
                <th scope="col">Creato</th>
            </tr>
        <tbody>

            <tr>
                <td>{{ Auth::user()->name }}</td>
                <td>{{ Auth::user()->email }}</td>
                <td>{{ Auth::user()->created_at }}</td>
                {{-- <td><a href="{{ route('profile.edit') }}">Modifica</a></td> --}}
            </tr>
        </tbody>
        </thead>
    @endsection

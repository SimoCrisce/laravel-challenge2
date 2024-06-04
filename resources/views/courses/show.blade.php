@extends('template.base')

@section('title', 'Corso')

@section('content')
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">Descrizione</th>
                <th scope="col">Luogo</th>
                <th scope="col">Giorno</th>
                <th scope="col">Inizio</th>
                <th scope="col">Fine</th>
                @auth
                    <th scope="col">Azioni</th>
                @endauth
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">{{ $course->id }}</th>
                <td>{{ $course->activity->name }}</td>
                <td>{{ $course->activity->description }}</td>
                <td class="text-nowrap">{{ $course->location }}</td>
                <td class="text-nowrap">{{ $course->slot->day }}</td>
                <td>{{ $course->slot->start }}</td>
                <td>{{ $course->slot->end }}</td>
                @auth
                    <td>
                        <div class="d-flex gap-1">
                            @if (Auth::user()->role === 'user')
                                @if ($course->users->contains(Auth::id()))
                                    <form action="{{ route('courses.annulla', ['id' => $course->id]) }}" method="POST">
                                        @csrf
                                        <button class="btn btn-danger">Annulla</button>
                                    </form>
                                @else
                                    <form action="{{ route('courses.prenota', ['id' => $course->id]) }}" method="POST">
                                        @csrf
                                        <button class="btn btn-success">Prenota</button>
                                    </form>
                                @endif
                            @endif
                            @if (Auth::user()->role === 'admin')
                                <a href="{{ route('courses.edit', ['id' => $course->id]) }}"
                                    class="btn btn-success">Modifica</a>
                            @endif
                        </div>
                    </td>
                @endauth
        </tbody>
    </table>
@endsection

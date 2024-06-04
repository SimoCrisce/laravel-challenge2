@extends('template.base')

@section('title', 'Lista corsi')

@section('content')
    @guest
        <h3>Fai il login per poterti prenotare!</h3>
    @endguest
    @auth
        @if (Auth::user()->role === 'admin')
            <a href="{{ route('courses.create') }}" class="btn btn-success">Aggiungi un corso</a>
        @endif
    @endauth
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
            @foreach ($courses as $course)
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
                                {{-- @if (in_array(Auth::id(), $course->users->pluck('id')->all())) --}}
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
                                @elseif(Auth::user()->role === 'admin')
                                    <form action="{{ route('courses.destroy', ['id' => $course->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger">Elimina</button>
                                    </form>
                                @endif
                                <a href="{{ route('courses.show', ['id' => $course->id]) }}"
                                    class="btn btn-primary">Dettagli</a>
                            </div>
                        </td>
                    @endauth
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $courses->links() }}
@endsection

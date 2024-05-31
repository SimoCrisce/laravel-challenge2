@extends('template.base')

@section('title', 'Dashboard')

@section('content')
    @if (!$courses->isEmpty())
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Descrizione</th>
                    <th scope="col">Per</th>
                    <th scope="col">Giorno</th>
                    <th scope="col">Inizio</th>
                    <th scope="col">Fine</th>
                    <th scope="col">Status</th>
                    @auth
                        <th scope="col">Azioni</th>
                    @endauth
                </tr>
            </thead>
            <tbody>
                @foreach ($courses as $course)
                    @foreach ($course->users as $user)
                        @auth
                            {{-- @if (in_array(Auth::id(), $course->users->pluck('id')->all())) --}}
                            @if (Auth::user()->role === 'admin')
                                <tr>
                                    <th scope="row">{{ $course->id }}</th>
                                    <td>{{ $course->activity->name }}</td>
                                    <td>{{ $course->activity->description }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td class="text-nowrap">{{ $course->slot->day }}</td>
                                    <td>{{ $course->slot->start }}</td>
                                    <td>{{ $course->slot->end }}</td>
                                    <td>{{ $user->pivot->status }}</td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <form
                                                action="{{ route('courses.accept', ['id' => $course->id, 'user' => $user->id]) }}"
                                                method="POST">
                                                @csrf
                                                <button class="btn btn-success">Accetta</button>
                                            </form>
                                            <form
                                                action="{{ route('courses.reject', ['id' => $course->id, 'user' => $user->id]) }}"
                                                method="POST">
                                                @csrf
                                                <button class="btn btn-danger">Rifiuta</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @else
                                @if ($user->id === Auth::id())
                                    <tr>
                                        <th scope="row">{{ $course->id }}</th>
                                        <td>{{ $course->activity->name }}</td>
                                        <td>{{ $course->activity->description }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td class="text-nowrap">{{ $course->slot->day }}</td>
                                        <td>{{ $course->slot->start }}</td>
                                        <td>{{ $course->slot->end }}</td>
                                        <td>{{ $user->pivot->status }}</td>
                                        <td>
                                            <form action="{{ route('courses.annulla', ['id' => $course->id]) }}"
                                                method="POST">
                                                @csrf
                                                <button class="btn btn-danger">Annulla</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endif
                            @endif
                        @endauth
                    @endforeach
                @endforeach
            </tbody>
        </table>
    @else
        <h2>Non hai prenotato alcuna attività</h2>
        <a href="{{ route('courses.index') }}">Naviga nei corsi</a>
    @endif
    {{ $courses->links() }}
@endsection

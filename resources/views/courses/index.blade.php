@extends('template.base')

@section('title', 'Lista corsi')

@section('content')
    @guest
      <h3>Fai il login per poterti prenotare!</h3>
    @endguest
    <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Nome</th>
            <th scope="col">Descrizione</th>
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
                <th scope="row">{{$course->id}}</th>
                <td>{{$course->activity->name}}</td>
                <td>{{$course->activity->description}}</td>
                <td class="text-nowrap">{{$course->slot->day}}</td>
                <td>{{$course->slot->start}}</td>
                <td>{{$course->slot->end}}</td>
                @auth
                <td>
                    {{-- @if (in_array(Auth::id(), $course->users->pluck('id')->all())) --}}
                    @if ($course->users->contains(Auth::id()))
                    <form action="{{route('courses.annulla', ['id' => $course->id])}}" method="POST">
                      @csrf
                      <button class="btn btn-danger">Annulla</button>
                    </form>
                    @else
                    <form action="{{route('courses.prenota', ['id' => $course->id])}}" method="POST">
                      @csrf
                    <button class="btn btn-success">Prenota</button>
                    </form>
                    @endif
                </td>
                @endauth
              </tr>
              @endforeach
        </tbody>
    </table>
    {{$courses->links()}}
@endsection
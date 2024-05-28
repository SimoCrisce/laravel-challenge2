@extends('template.base')

@section('title', 'Lista corsi')

@section('content')
    <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Nome</th>
            <th scope="col">Descrizione</th>
            <th scope="col">Giorno</th>
            <th scope="col">Inizio</th>
            <th scope="col">Fine</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($courses as $course)  
            <tr>
                <th scope="row">{{$course->id}}</th>
                <td>{{$course->activity->name}}</td>
                <td>{{$course->activity->description}}</td>
                <td>{{$course->slot->day}}</td>
                <td>{{$course->slot->start}}</td>
                <td>{{$course->slot->end}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection
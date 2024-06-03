@extends('template.base')

@section('title', 'Aggiungi attività')

@section('content')
    <div class="row">
        <div class="col-6">
            <h2>Inserisci un nuovo corso</h2>
            <form action="{{ route('courses.store') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-6">
                        <select class="form-select" name="activity_id">
                            <option disabled selected>Attività</option>
                            @foreach ($activities as $activity)
                                <option value="{{ $activity->id }}">{{ $activity->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-6">
                        <select class="form-select" name="slot_id">
                            <option disabled selected>Giorno</option>
                            @foreach ($slots as $slot)
                                <option value="{{ $slot->id }}">{{ $slot->day }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12">
                        <div class="mb-3">
                            <label for="location" class="form-label">Luogo</label>
                            <input class="form-control" id="location" name="location">
                        </div>
                        <button class="btn btn-success">Pubblica</button>
                    </div>
            </form>
        </div>
    </div>
    </div>
@endsection

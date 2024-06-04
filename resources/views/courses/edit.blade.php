@extends('template.base')

@section('title', 'Modifica corso')

@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row">
        <div class="col-6">
            <h2>Modifica corso</h2>
            <form action="{{ route('courses.update', ['id' => $id]) }}" method="post">
                @method('PUT')
                @csrf
                <div class="row">
                    <div class="col-6">
                        <select class="form-select" name="activity_id">
                            <option disabled selected>Attività</option>
                            @foreach ($activities as $activity)
                                <option value="{{ $activity->id }}"
                                    {{ $activity->id == old('activity_id', $id->activity->id) ? 'selected' : '' }}>
                                    {{ $activity->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-6">
                        <select class="form-select" name="slot_id">
                            <option disabled selected>Giorno</option>
                            @foreach ($slots as $slot)
                                <option value="{{ $slot->id }}"
                                    {{ $slot->id == old('slot_id', $id->slot->id) ? 'selected' : '' }}>{{ $slot->day }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12">
                        <div class="mb-3">
                            <label for="location" class="form-label">Luogo</label>
                            <input class="form-control" id="location" name="location"
                                value="{{ old('location', $id->location) }}">
                        </div>
                        <button class="btn btn-success">Modifica</button>
                    </div>
            </form>
        </div>
    </div>
    </div>
@endsection

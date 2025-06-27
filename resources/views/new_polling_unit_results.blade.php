@extends('layouts.app')

@section('content')
    <div class="card p-4 mb-4">
        <h1 class="h4 fw-bold mb-4">New Polling Unit Results</h1>

        <form action="{{ route('store.new.polling.unit.result') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="polling_unit_uniqueid" class="form-label fw-semibold">Polling Unit Unique ID:</label>
                <input type="text" 
                       name="polling_unit_uniqueid" 
                       id="polling_unit_uniqueid" 
                       class="form-control @error('polling_unit_uniqueid') is-invalid @enderror" 
                       value="{{ old('polling_unit_uniqueid') }}" 
                       placeholder="e.g., 280 (new ID) or existing uniqueid">
                @error('polling_unit_uniqueid')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="entered_by_user" class="form-label fw-semibold">Entered By User:</label>
                <input type="text" 
                       name="entered_by_user" 
                       id="entered_by_user" 
                       class="form-control @error('entered_by_user') is-invalid @enderror" 
                       value="{{ old('entered_by_user') }}" 
                       placeholder="Your Name">
                @error('entered_by_user')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <h2 class="h5 fw-semibold mt-4 mb-3">Party Scores:</h2>
            @foreach ($parties as $party)
                <div class="mb-3">
                    <label for="party_{{ $party->partyid }}" class="form-label">
                        {{ $party->partyname }} ({{ $party->partyid }}):
                    </label>
                    <input type="number" 
                           name="party_scores[{{ $party->partyid }}]" 
                           id="party_{{ $party->partyid }}" 
                           class="form-control @error('party_scores.' . $party->partyid) is-invalid @enderror" 
                           value="{{ old('party_scores.' . $party->partyid, 0) }}" 
                           min="0">
                    @error('party_scores.' . $party->partyid)
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            @endforeach

            @error('party_scores')
                <div class="text-danger small">{{ $message }}</div>
            @enderror

            <button type="submit" class="btn btn-primary mt-3">Store Results</button>
        </form>
    </div>
@endsection

@extends('layouts.app')

@section('content')
    <div class="card p-4 mb-4">
        <h1 class="h4 fw-bold mb-4">Polling Unit Results</h1>

        <form action="{{ route('polling.unit.results') }}" method="POST" class="mb-4">
            @csrf
            <div class="mb-3">
                <label for="polling_unit_uniqueid" class="form-label fw-semibold">Select Polling Unit:</label>
                <select name="polling_unit_uniqueid" id="polling_unit_uniqueid" class="form-select">
                    <option value="">-- Select a Polling Unit --</option>
                    @foreach ($pollingUnits as $pu)
                        <option value="{{ $pu->uniqueid }}" {{ old('polling_unit_uniqueid', $selectedPollingUnit->uniqueid ?? '') == $pu->uniqueid ? 'selected' : '' }}>
                            PU ID: {{ $pu->uniqueid }} - {{ $pu->polling_unit_name }} (LGA: {{ $pu->lga->lga_name ?? 'N/A' }}, Ward: {{ $pu->ward->ward_name ?? 'N/A' }})
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Show Results</button>
        </form>

        @if ($selectedPollingUnit)
            <div class="alert alert-info mb-4">
                <h2 class="h5 fw-semibold mb-2">Results for Polling Unit: {{ $selectedPollingUnit->polling_unit_name }} (ID: {{ $selectedPollingUnit->uniqueid }})</h2>
                <p><strong>LGA:</strong> {{ $selectedPollingUnit->lga->lga_name ?? 'N/A' }}</p>
                <p><strong>Ward:</strong> {{ $selectedPollingUnit->ward->ward_name ?? 'N/A' }}</p>
            </div>

            @if ($results->isNotEmpty())
                <h3 class="h5 fw-bold mb-3">Party Scores:</h3>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th>Party Abbreviation</th>
                                <th>Score</th>
                                <th>Entered By</th>
                                <th>Date Entered</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($results as $result)
                                <tr>
                                    <td>{{ $result->party_abbreviation }}</td>
                                    <td>{{ $result->party_score }}</td>
                                    <td>{{ $result->entered_by_user }}</td>
                                    <td>{{ $result->date_entered }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-muted">No results found for this polling unit.</p>
            @endif
        @else
            <p class="text-muted">Please select a polling unit to view its results.</p>
        @endif
    </div>
@endsection

@extends('layouts.app')

@section('content')
    <div class="card p-4 mb-4">
        <h1 class="h4 mb-4 fw-bold">Summed LGA Results from Polling Units</h1>

        <form action="{{ route('lga.summed.results') }}" method="POST" class="mb-4">
            @csrf
            <div class="mb-3">
                <label for="lga_id" class="form-label fw-semibold">Select Local Government Area (LGA):</label>
                <select name="lga_id" id="lga_id" class="form-select">
                    <option value="">-- Select an LGA --</option>
                    @foreach ($lgas as $lga)
                        <option value="{{ $lga->lga_id }}" {{ old('lga_id', $selectedLga->lga_id ?? '') == $lga->lga_id ? 'selected' : '' }}>
                            {{ $lga->lga_name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Show Summed Results</button>
        </form>

        @if ($selectedLga)
            <div class="alert alert-info mb-4">
                <h2 class="h5 fw-semibold mb-2">Summed Results for LGA: {{ $selectedLga->lga_name }} (ID: {{ $selectedLga->lga_id }})</h2>
            </div>

            @if ($summedResults->isNotEmpty())
                <h3 class="h5 fw-bold mb-3">Party Scores Summed Across All Polling Units in this LGA:</h3>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th>Party Abbreviation</th>
                                <th>Total Score</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($summedResults as $result)
                                <tr>
                                    <td>{{ $result->party_abbreviation }}</td>
                                    <td>{{ $result->total_score }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-muted">No polling unit results found for this LGA to sum.</p>
            @endif
        @else
            <p class="text-muted">Please select an LGA to view its summed results.</p>
        @endif
    </div>
@endsection
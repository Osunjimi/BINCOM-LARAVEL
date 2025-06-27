<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Election Results App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fa;
            color: #333;
        }
        .card {
            border-radius: 0.75rem;
        }
        .alert-success {
            background-color: #d1fae5;
            color: #065f46;
            border: 1px solid #10b981;
        }
        .alert-error {
            background-color: #fee2e2;
            color: #991b1b;
            border: 1px solid #ef4444;
        }
        .error-message {
            color: #dc3545;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }
    </style>
</head>
<body class="bg-light py-4">
    <div class="container">
        <nav class="navbar navbar-expand-lg bg-white p-3 rounded shadow mb-4">
            <div class="container-fluid justify-content-center">
                <ul class="navbar-nav d-flex flex-row gap-3">
                    <li class="nav-item">
                        <a class="nav-link text-primary fw-semibold" href="{{ route('polling.unit.results') }}">Polling Unit Results</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-primary fw-semibold" href="{{ route('lga.summed.results') }}">LGA Summed Results</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-primary fw-semibold" href="{{ route('new.polling.unit.result') }}">Add New Polling Unit Result</a>
                    </li>
                </ul>
            </div>
        </nav>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-error">
                {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </div>
    <p class="text-center text-primary">Designed by osunjimi ibrahim</p>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

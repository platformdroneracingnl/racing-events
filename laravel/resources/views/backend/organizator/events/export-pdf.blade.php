@php
    use Carbon\Carbon;
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'PDRNL Dashboard') }}</title>

    <!-- CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ public_path('/pdrnl/css/style.css')}}">
</head>
<body style="background-color: white;">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Nr.</th>
                <th scope="col">Naam</th>
                <th scope="col">Land</th>
                <th scope="col">Pilot name</th>
                <th scope="col">Race team</th>
                <th scope="col">E-mail</th>
                <th scope="col">Aangemeld op</th>
                <th scope="col">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($registrations as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->user->first()->name }}</td>
                    <td></td>
                    <td>{{ $item->user->first()->pilot_name }}</td>
                    <td>{{ $item->user->first()->race_team }}</td>
                    <td>{{ $item->user->first()->email }}</td>
                    <td>{{ $item->created_at->format('d-m-Y H:i:s') }}</td>
                    <td>{{ __($item->status->name) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <script src="{{ public_path('vendor') }}/bootstrap/bootstrap.min.js"></script>
</body>
</html>
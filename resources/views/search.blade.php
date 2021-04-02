<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Explorer demo app</title>
</head>
<body>
    <h1>Search cartographers</h1>
    <form action="/search" method="post">
        @csrf
        <label>
            Keywords
            <input type="text" name="keywords" autocomplete="off" />
        </label>

        @foreach($countries as $country)
            <label>
                <input type="checkbox" name="countries[]" value="{{ $country }}" />
                {{ $country }}
            </label>
        @endforeach

        <button type="submit">Search</button>
    </form>

    <div>
        <h2>Results</h2>
        <ul>
            @foreach($people as $person)
                <li>{{ $person->name }}</li>
            @endforeach
        </ul>
    </div>

    <div>
        <h2>Query</h2>
        <pre>{{ $query ?? 'none' }}</pre>
    </div>
</body>
</html>

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

        <button type="submit">Search</button>
    </form>

    <div>
        <ul>
            @foreach($people as $person)
                <li>{{ $person->name }}</li>
            @endforeach
        </ul>
    </div>
</body>
</html>

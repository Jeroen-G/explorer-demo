@extends('layout')

@section('body')
    <main>
        <section class="prose">
            <h1>Paginated cartographers</h1>
            <ul>
                @foreach($people as $person)
                    <li>{{ $person->name }}</li>
                @endforeach
            </ul>

            <span>page {{ $people->currentPage() }} of {{ round($people->total() / $people->perPage()) }}</span>
            <div>
                @if ($people->currentPage() !== 1)<a href="{{ $people->previousPageUrl() }}">Previous</a>@endif
                @if ($people->hasMorePages())<a href="{{ $people->nextPageUrl() }}">Next</a>@endif
            </div>
        </section>
    </main>
@endsection

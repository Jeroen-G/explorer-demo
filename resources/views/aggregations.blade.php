@extends('layout')

@section('body')
    <main>
        <section class="prose">
            <h1>Aggregations</h1>

            <ul>
                @foreach($aggregations as $aggregation)
                    <li>
                        <h2>{{ $aggregation->name() }}</h2>

                        <ul>
                            @foreach($aggregation->values() as $aggregationValue)
                                <li>{{ $aggregationValue['key'] }}: {{ $aggregationValue['doc_count'] }}</li>
                            @endforeach
                        </ul>
                    </li>
                @endforeach
            </ul>
        </section>

        <section class="prose mt-10 max-w-5xl">
            <h2>Query</h2>
            <pre class="">{{ $query ?? 'none' }}</pre>
        </section>
    </main>
@endsection

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Movie</title>
</head>
<body>
    <h1>{{ $movie->title }}</h1>

    <p><strong>公開年:</strong> {{ $movie->published_year }}</p>
    <p><strong>概要:</strong> {{ $movie->description }}</p>
    <p><strong>上映中:</strong> {{ $movie->is_showing ? '上映中' : '上映終了' }}</p>

    @if ($movie->image_url)
        <div>
            <img src="{{ $movie->image_url }}" alt="{{ $movie->title }}" width="300">
        </div>
    @endif

    <hr>

    <h2>上映スケジュール</h2>

    @if (count($schedules) > 0)
        <ul>
            @foreach ($schedules as $schedule)
                <li>
                    開始: {{ $schedule->start_time->format('H:i') }}
                    終了: {{ $schedule->end_time->format('H:i') }}
                </li>
            @endforeach
        </ul>
    @else
        <p>現在、この映画の上映スケジュールはありません。</p>
    @endif

    <hr>
    <a href="{{ url('/movies') }}">← 映画一覧に戻る</a>
</body>
</html>
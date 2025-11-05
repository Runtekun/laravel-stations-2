<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Movie</title>
</head>

<body>
    <h1>上映スケジュール一覧</h1>

    {{-- スケジュールが存在する映画ごとにループ --}}
    @foreach ($movies as $movie)
        <h2>作品ID: {{ $movie->id }} 作品名: {{ $movie->title }}</h2>

        <ul>
            @foreach ($movie->schedules as $schedule)
                <li>
                    <strong>スケジュールID:</strong> {{ $schedule->id }}<br>
                    <strong>開始時刻:</strong> {{ $schedule->start_time }}<br>
                    <strong>終了時刻:</strong> {{ $schedule->end_time }}<br>
                    <strong>作成日時:</strong> {{ $schedule->created_at }}<br>
                    <strong>更新日時:</strong> {{ $schedule->updated_at }}<br>

                    <a href="{{ route('admin.schedules.show', $schedule->id) }}">詳細</a>
                    |
                    <a href="{{ route('admin.schedules.edit', $schedule->id) }}">編集</a>
                    |
                    <form action="{{ route('admin.schedules.destroy', $schedule->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('本当に削除しますか？')">削除</button>
                    </form>
                </li>
                <hr>
            @endforeach
        </ul>
    @endforeach
</body>
</html>
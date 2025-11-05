<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Movie</title>
</head>

<body>
    <h1>スケジュール詳細</h1>

    <h2>作品名: {{ $schedule->movie->title }}</h2>

    <p><strong>スケジュールID:</strong> {{ $schedule->id }}</p>
    <p><strong>作品ID:</strong> {{ $schedule->movie_id }}</p>
    <p><strong>開始時刻:</strong> {{ $schedule->start_time }}</p>
    <p><strong>終了時刻:</strong> {{ $schedule->end_time }}</p>
    <p><strong>作成日時:</strong> {{ $schedule->created_at }}</p>
    <p><strong>更新日時:</strong> {{ $schedule->updated_at }}</p>

    <a href="{{ route('admin.schedules.edit', $schedule->id) }}">編集</a> |
    <form action="{{ route('admin.schedules.destroy', $schedule->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" onclick="return confirm('本当に削除しますか？')">削除</button>
    </form>

    <br><br>
    <a href="{{ route('admin.movies.show', $schedule->movie_id) }}">← 作品詳細に戻る</a>
</body>
</html>
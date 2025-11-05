<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Movie</title>
</head>

<body>
    <h1>スケジュール新規作成</h1>

    <h2>作品名: {{ $movie->title }}</h2>

    <form action="{{ route('admin.schedules.store', ['id' => $movie->id]) }}" method="POST">
        @csrf
        <input type="hidden" name="movie_id" value="{{ $movie->id }}">

        <p>
            <label>開始日付:
                <input type="date" name="start_time_date" required>
            </label>
        </p>

        <p>
            <label>開始時間:
                <input type="time" name="start_time_time" required>
            </label>
        </p>

        <p>
            <label>終了日付:
                <input type="date" name="end_time_date" required>
            </label>
        </p>

        <p>
            <label>終了時間:
                <input type="time" name="end_time_time" required>
            </label>
        </p>

        <button type="submit">登録する</button>
    </form>

    <br>
    <a href="{{ route('admin.movies.show', $movie->id) }}">← 作品詳細に戻る</a>
</body>
</html>
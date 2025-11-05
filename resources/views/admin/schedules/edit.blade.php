<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Movie</title>
</head>

<body>
    <h1>スケジュール編集</h1>

    <h2>作品名: {{ $schedule->movie->title }}</h2>

    {{-- 更新フォーム --}}
    <form action="{{ route('admin.schedules.update', $schedule->id) }}" method="POST">
        @csrf
        @method('PATCH')

        {{-- テスト仕様対応：movie_idをhiddenで送る --}}
        <input type="hidden" name="movie_id" value="{{ $schedule->movie->id }}">

        <p>
            <label>開始日付:
                <input type="date" name="start_time_date"
                    value="{{ old('start_time_date', $schedule->start_time->format('Y-m-d')) }}" required>
            </label>
        </p>

        <p>
            <label>開始時間:
                <input type="time" name="start_time_time"
                    value="{{ old('start_time_time', $schedule->start_time->format('H:i')) }}" required>
            </label>
        </p>

        <p>
            <label>終了日付:
                <input type="date" name="end_time_date"
                    value="{{ old('end_time_date', $schedule->end_time->format('Y-m-d')) }}" required>
            </label>
        </p>

        <p>
            <label>終了時間:
                <input type="time" name="end_time_time"
                    value="{{ old('end_time_time', $schedule->end_time->format('H:i')) }}" required>
            </label>
        </p>

        <button type="submit">更新する</button>
    </form>

    <br>

    {{-- 削除フォーム --}}
    <form action="{{ route('admin.schedules.destroy', $schedule->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" onclick="return confirm('本当に削除しますか？')">削除</button>
    </form>

    <br>
    <a href="{{ route('admin.schedules.show', $schedule->id) }}">← スケジュール詳細に戻る</a>
</body>
</html>
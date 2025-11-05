<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Movie</title>
</head>

<body>
    <h1>{{ $movie->title }} の詳細</h1>

    <table border="1">
        <tr>
            <th>タイトル</th>
            <td>{{ $movie->title }}</td>
        </tr>
        <tr>
            <th>画像</th>
            <td><img src="{{ $movie->image_url }}" alt="映画ポスター" width="120"></td>
        </tr>
        <tr>
            <th>公開年</th>
            <td>{{ $movie->published_year }}</td>
        </tr>
        <tr>
            <th>概要</th>
            <td>{{ $movie->description }}</td>
        </tr>
        <tr>
            <th>上映状況</th>
            <td>{{ $movie->is_showing ? '上映中' : '上映予定' }}</td>
        </tr>
        <tr>
            <th>ジャンル</th>
            <td>{{ $movie->genre->name ?? '未設定' }}</td>
        </tr>
    </table>

    <hr>

    <h2>上映スケジュール一覧</h2>

    @if ($schedules->isEmpty())
        <p>現在、登録されているスケジュールはありません。</p>
    @else
        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>開始時刻</th>
                    <th>終了時刻</th>
                    <th>作成日時</th>
                    <th>更新日時</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($schedules as $schedule)
                    <tr>
                        <td>{{ $schedule->id }}</td>
                        <td>{{ $schedule->start_time }}</td>
                        <td>{{ $schedule->end_time }}</td>
                        <td>{{ $schedule->created_at }}</td>
                        <td>{{ $schedule->updated_at }}</td>
                        <td>
                            {{-- showルートは {id} --}}
                            <a href="{{ route('admin.schedules.show', ['id' => $schedule->id]) }}">詳細</a> |

                            {{-- editルートは {scheduleId} --}}
                            <a href="{{ route('admin.schedules.edit', ['scheduleId' => $schedule->id]) }}">編集</a>

                            {{-- destroyルートも {scheduleId} --}}
                            <form action="{{ route('admin.schedules.destroy', ['scheduleId' => $schedule->id]) }}" method="POST" style="display:inline" onsubmit="return confirm('本当に削除しますか？');">
                                @csrf
                                @method('DELETE')
                                <button type="submit">削除</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <br>
    <a href="{{ route('admin.schedules.create', ['id' => $movie->id]) }}">＋ スケジュールを追加</a>
    <br><br>
    <a href="{{ route('admin.movies.index') }}">← 映画一覧に戻る</a>
</body>
</html>
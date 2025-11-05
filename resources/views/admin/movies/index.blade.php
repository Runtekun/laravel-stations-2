<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Movie</title>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>タイトル</th>
                <th>画像</th>
                <th>公開年</th>
                <th>概要</th>
                <th>上映状況</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($movies as $movie)
                <tr>
                    <td>{{ $movie->title }}</td>
                    <td><img src="{{ $movie->image_url }}" alt="映画のポスター"></td>
                    <td>{{ $movie->published_year }}</td>
                    <td>{{ $movie->description }}</td>
                    <td>{{ $movie->is_showing ? '上映中' : '上映予定' }}</td>
                    <td> 
                        <a href="{{ route('admin.movies.edit', ['id' => $movie->id]) }}">編集</a>
                    </td>
                    <td>
                        <form action="{{ route('admin.movies.destroy', ['id' => $movie->id]) }}" method="POST" onsubmit="return confirm('本当に削除しますか？');">
                        @csrf
                        @method('DELETE')
                        <button type="submit">削除</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
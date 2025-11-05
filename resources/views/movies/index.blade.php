<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Movie</title>
</head>
<body>
    <h1>映画リスト</h1>

    {{-- 🔍 検索フォーム --}}
    <form action="{{ route('movies.index') }}" method="GET">
        <input type="text" name="keyword" value="{{ request('keyword') }}" placeholder="タイトル・概要で検索">

        <label>
            <input type="radio" name="is_showing" value="" {{ request('is_showing') === null ? 'checked' : '' }}>
            すべて
        </label>
        <label>
            <input type="radio" name="is_showing" value="1" {{ request('is_showing') === '1' ? 'checked' : '' }}>
            公開中
        </label>
        <label>
            <input type="radio" name="is_showing" value="0" {{ request('is_showing') === '0' ? 'checked' : '' }}>
            公開予定
        </label>

        <button type="submit">検索</button>
    </form>

    <hr>

    {{-- 🎬 映画リスト --}}
    <ul>
        @forelse ($movies as $movie)
            <li>
                <strong>タイトル：</strong>{{ $movie->title }}<br>
                <img src="{{ $movie->image_url }}" alt="映画のポスター画像" width="150">
            </li>
        @empty
            <p>該当する映画はありません。</p>
        @endforelse
    </ul>

    {{-- 📄 ページネーション --}}
    <div>
        {{ $movies->appends(request()->query())->links() }}
    </div>
</body>
</html>
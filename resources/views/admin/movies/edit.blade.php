<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Movie</title>
</head>
<body>
    <h1>映画編集</h1>
    <form action="{{ route('admin.movies.update', ['id' => $movie->id]) }}" method="POST">
        @csrf
        @method('PATCH')
        @include('admin.movies.form')
        <button type="submit">更新</button>
    </form>
</body>
</html>
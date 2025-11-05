<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Movie</title>
</head>
<body>

    <form action="{{ route('admin.movies.store') }}" method="POST">
        @csrf
        @include('admin.movies.form')
    </form>
</body>
</html>
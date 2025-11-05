<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Movie</title>
</head>
<body>
    <h1>映画館座席表</h1>
    <table>
        <tr>
            <td class="screen" colspan="5">スクリーン</td>
        </tr>
        @foreach ($sheets as $row => $columns)
            <tr>
                @foreach ($columns as $sheet)
                    <td>{{ $sheet->row }}-{{ $sheet->column }}</td>
                @endforeach
            </tr>
        @endforeach
    </table>
</body>
</html>

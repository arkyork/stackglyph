<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h1>正解率ランキング</h1>
<table border="1" cellpadding="5">
  <tr>
    <th>単語</th>
    <th>正解率</th>
    <th>出題数</th>
    <th>正解数</th>
  </tr>
  @foreach ($words as $stat)
    <tr>
      <td>{{ $stat->word->text }}</td>
      <td>{{ $stat->correct_rate !== null ? $stat->correct_rate . '%' : '－' }}</td>
      <td>{{ $stat->play_count }}</td>
      <td>{{ $stat->correct_count }}</td>
    </tr>
  @endforeach
</table>

</body>
</html>
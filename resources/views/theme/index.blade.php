<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>一覧</title>
    <style>
        table { border-collapse: collapse; width: 100%; margin-top: 1em; }
        th, td { border: 1px solid #ccc; padding: 0.5em; text-align: left; }
        th { background: #eee; }
    </style>
</head>
<body>
    <h1>一覧</h1>

    @foreach($themes as $theme)
        <h2><a href="{{ route('themes.edit', $theme->id) }}">{{ $theme->name }}</a>（{{ $theme->category->name }}） @if($theme->is_public)🌐@else🔒@endif</h2>
        <table>
            <thead>
                <tr>
                    <th>単語</th>
                    <th>出題回数</th>
                    <th>正解数</th>
                    <th>ヒント使用</th>
                    <th>フラッシュカード使用</th>
                    <th>正解率</th>
                    <th>ヒント使用率</th>
                </tr>
            </thead>
            <tbody>
                @foreach($theme->words as $word)
                    @php
                        $stats = $word->wordStatistics;
                        $play = $stats->play_count ?? 0;
                        $correct = $stats->correct_count ?? 0;
                        $hint = $stats->hint_count ?? 0;
                        $flash = $stats->flashcard_count ?? 0;
                        $rate = $play ? round($correct / $play * 100, 1) : '-';
                        $hintRate = $play ? round($hint / $play * 100, 1) : '-';
                    @endphp
                    <tr>
                        <td>{{ $word->text }}</td>
                        <td>{{ $play }}</td>
                        <td>{{ $correct }}</td>
                        <td>{{ $hint }}</td>
                        <td>{{ $flash }}</td>
                        <td>{{ is_numeric($rate) ? "$rate%" : '-' }}</td>
                        <td>{{ is_numeric($hintRate) ? "$hintRate%" : '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endforeach
</body>
</html>

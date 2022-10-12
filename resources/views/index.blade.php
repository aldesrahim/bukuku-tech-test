<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

@if($message = session()->get('message'))
    <p>{{ $message }}</p>
@endif

<form action="{{ route('delete') }}" method="post" onsubmit="return confirm('Apakah Anda yakin ?')">
    @csrf
    @method('DELETE')

    <button type="submit">Hapus semua</button>
    <button type="button" onclick="window.location.reload()">Refresh</button>
</form>

<ul>
    @foreach($files as $file)
        <li>
            <a href="storage/exchange-rate/{{ $file }}" target="_blank">{{ $file }}</a>
        </li>
    @endforeach
</ul>

</body>
</html>

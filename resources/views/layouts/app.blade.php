<!DOCTYPE html>
<html lang="ja">
<head>
<title>{{ config('app.name', '') }}</title>
<style>
  pre {
    padding: 1em;
    border: 1px solid #000;
    background-color: #f6f6f6;
  }

  table, table th, table td {
    border-collapse: collapse;
    border: 1px solid;
    padding: 5px;
  }
</style>
</head>
<body>
@yield('content')
</body>
</html>
